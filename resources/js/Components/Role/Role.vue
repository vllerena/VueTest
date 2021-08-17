<template>
    <div>
        <header class="page-header">
            <h2>Role Page</h2>
            <div class="right-wrapper text-right">
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Role List <Button @click="addModal=true" class="btn btn-primary waves-effect waves-light ml-3"><Icon type="md-add" /> Add Role</Button></h2>
            </header>
            <div class="card-body">
                <table class="table table-responsive-md table-hover mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Permission</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(rol, i) in roles" :key="i" v-if="roles.length">
                        <td>{{rol.id}}</td>
                        <td>{{rol.name}}</td>
                        <td>{{rol.permission}}</td>
                        <td>{{rol.created_at}}</td>
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
            title="Add Role"
            :mask-closable="false"
            :closable="false">
            <Input v-model="data.name" placeholder="Add role name" />
            <Input v-model="data.permission" placeholder="Add permission" />
            <div slot="footer">
                <Button type="default" @click="addModal=false">Close</Button>
                <Button type="primary" @click="addRole" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add Role'}}</Button>
            </div>
        </Modal>
    </div>
</template>

<script>
export default {
    name: "Role",
    created() {
        this.allRoles()
        if (!User.loggedIn()){
            this.$router.push({name: '/'})
        }
    },
    data(){
        return{
            data : {
                name: '',
                permission: '',
            },
            editData: {
                name: '',
                permission: '',
            },
            addModal: false,
            editModal: false,
            deleteModal: false,
            isAdding: false,
            isEditing: false,
            isDeleting: false,
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
        async addRole(){
            this.isAdding = true
            let token = User.token();
            await AxiosWrapper.post({
                url: '/api/auth/role',
                authToken: token,
                payload: this.data,
                then: ((res) => {
                    this.roles.unshift(res.data)
                    Toast.fire({
                        icon: 'success',
                        title: 'Rol registrado correctamente'
                    })
                    this.data.name = ''
                    this.data.permission = ''
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
