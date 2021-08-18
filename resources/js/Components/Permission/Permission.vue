<template>
    <div>
        <header class="page-header">
            <h2>Permission Page</h2>
            <div class="right-wrapper text-right">
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>
        <section class="card">
            <header class="card-header">
                <h2 class="card-title mb-2">Add Permission (Select role first)</h2>
                <Select v-model="data.id" @on-change="getPermission" filterable placeholder="Add rol" style="width: 350px">
                    <Option v-for="item in roles" :value="item.id" :key="item.id">{{ item.name }}</Option>
                </Select>
            </header>
            <div v-if="data.id">
                <div class="card-body">
                    <table class="table table-responsive-md table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Read</th>
                            <th>Write</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(m, i) in models" :key="i" >
                            <td>{{m.model}}</td>
                            <td><Checkbox v-model="m.read"></Checkbox></td>
                            <td><Checkbox v-model="m.write"></Checkbox></td>
                            <td><Checkbox v-model="m.update"></Checkbox></td>
                            <td><Checkbox v-model="m.delete"></Checkbox></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="center-button">
                        <Button type="primary" :loading="isSending" :disabled="isSending" @click="addPermission">{{isSending ? 'Sending..' : 'Send Permission'}}</Button>
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>

<script>
import AppStorage from "../../Helpers/AppStorage";

export default {
    name: "Permission",
    created() {
        this.allRoles()
        if (!User.loggedIn()){
            AppStorage.clear()
            this.$store.commit('setUpdateUser', false)
            this.$store.commit('setUserName', '')
            this.$router.push({name: '/'})
            window.location.reload()
        }
    },
    data() {
        return {
            data : {
                roleName: '',
                id: null,
            },
            models: [
                {model: 'Home', read: false, write: false, update:false, delete:false, name: 'home'},
                {model: 'User', read: false, write: false, update:false, delete:false, name: 'user'},
                {model: 'Role', read: false, write: false, update:false, delete:false, name: 'role'},
                {model: 'Permission', read: false, write: false, update:false, delete:false, name: 'permission'},
            ],
            modelsDefault: [
                {model: 'Home', read: false, write: false, update:false, delete:false, name: 'home'},
                {model: 'User', read: false, write: false, update:false, delete:false, name: 'user'},
                {model: 'Role', read: false, write: false, update:false, delete:false, name: 'role'},
                {model: 'Permission', read: false, write: false, update:false, delete:false, name: 'permission'},
            ],
            roles: [],
            isSending: false,
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
                    if (data.data.length){
                        this.data.id = data.data[0].id
                        if(data.data[0].permission){
                            this.models = JSON.parse(data.data[0].permission)
                        }
                    }
                }),
                error: ((err) =>
                    Toast.fire({
                        icon: 'error',
                        title: err.msg
                    })),
            })
        },
        async addPermission(){
            this.isSending = true
            let token = User.token();
            let data = JSON.stringify(this.models)
            await AxiosWrapper.post({
                url: '/api/auth/permission',
                authToken: token,
                payload: {'permission': data, 'id': this.data.id},
                then: ((res) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Permisos agregados correctamente'
                    })
                    let index = this.roles.findIndex(role => role.id === this.data.id)
                    this.roles[index].permission = data
                }),
                error: ((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: err.msg
                    })
                }),
                formErrors: (err) => this.errors = err.errors,
            })
            this.isSending = false
        },
        async getPermission(){
            let index = this.roles.findIndex(role => role.id === this.data.id)
            let permission = this.roles[index].permission
            if (!permission){
                this.models = this.modelsDefault
            }else {
                this.models = JSON.parse(permission)
            }
        }
    }
}
</script>

<style scoped>
    .center-button{
        text-align: center;
    }
</style>
