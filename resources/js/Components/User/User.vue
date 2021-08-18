<template>
    <div>
        <header class="page-header">
            <h2>User Page</h2>
            <div class="right-wrapper text-right">
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">User List <Button @click="addModal=true" class="btn btn-primary waves-effect waves-light ml-3"><Icon type="md-add" /> Add User</Button></h2>
            </header>
            <div class="card-body">
                <table class="table table-responsive-md table-hover mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user, i) in users" :key="i" v-if="users.length">
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.role_id}}</td>
                        <td>{{user.created_at}}</td>
                        <td class="actions-hover actions-fade">
                            <a href=""><i class="fas fa-pencil-alt"></i></a>
                            <a href="" class="delete-row"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <Modal
            v-model="addModal"
            title="Add User"
            :mask-closable="false"
            :closable="false">
            <Input v-model="data.name" placeholder="Add role name" />
            <Input v-model="data.username" placeholder="Add username" />
            <Input v-model="data.password" placeholder="Add password" />
<!--            <Input v-model="data.role_id" placeholder="Add rol" />-->
            <Select v-model="data.role_id" filterable placeholder="Add rol">
                <Option v-for="item in roles" :value="item.id" :key="item.id">{{ item.name }}</Option>
            </Select>
            <div slot="footer">
                <Button type="default" @click="addModal=false">Close</Button>
                <Button type="primary" @click="addUser" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add User'}}</Button>
            </div>
        </Modal>
    </div>
</template>

<script>
import AppStorage from "../../Helpers/AppStorage";

export default {
    name: "User",
    created() {
        this.allUsers()
        this.allRoles()
        if (!User.loggedIn()){
            AppStorage.clear()
            this.$store.commit('setUpdateUser', false)
            this.$store.commit('setUserName', '')
            this.$router.push({name: '/'})
            window.location.reload()
        }
    },
    data(){
        return{
            data : {
                name: '',
                username: '',
                password: '',
                role_id: '',
            },
            editData: {
                name: '',
                username: '',
                password: '',
                role_id: '',
            },
            addModal: false,
            editModal: false,
            deleteModal: false,
            isAdding: false,
            isEditing: false,
            isDeleting: false,
            users: [],
            roles: [],
            index: -1,
            deleteItem: {},
            deletingIndex: -1,
        }
    },
    methods: {
        async allRoles(){
            let token = User.token();
            await AxiosWrapper.get({
                url: '/api/auth/role',
                authToken: token,
                then: (({data}) => {
                    this.roles = data.data
                }),
                error: ((err) =>
                    Toast.fire({
                        icon: 'error',
                        title: err.msg
                    })),
            })
        },
        async allUsers(){
            let token = User.token();
            await AxiosWrapper.get({
                url: '/api/auth/user',
                authToken: token,
                then: (({data}) => {
                    this.users = data.data
                }),
                error: ((err) =>
                    Toast.fire({
                        icon: 'error',
                        title: err.msg
                    })),
            })
        },
        async addUser(){
            this.isAdding = true
            let token = User.token();
            await AxiosWrapper.post({
                url: '/api/auth/user',
                authToken: token,
                payload: this.data,
                then: ((res) => {
                    this.users.unshift(res.data)
                    Toast.fire({
                        icon: 'success',
                        title: 'Rol registrado correctamente'
                    })
                    this.data.name = ''
                    this.data.username = ''
                    this.data.password = ''
                    this.data.role_id = ''
                }),
                error: ((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: err.msg
                    })
                }),
                formErrors: (err) => this.errors = err.errors,
            })
            this.isAdding = false
            this.addModal = false
        }
    }
}
</script>

<style scoped>

</style>
