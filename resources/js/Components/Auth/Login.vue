<template>
    <div>
        <section class="body-sign">
            <div class="center-sign">
                <a href="/" class="logo float-left">
                    <img src="assets/img/logos/logo-dark.svg" height="54" alt="Logo Admin" />
                </a>
                <div class="panel card-sign">
                    <div class="card-title-sign mt-3 text-right">
                        <h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle mr-1 text-6 position-relative top-5"></i> Sign In</h2>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="form-group mb-3">
                                <label>Username</label>
                                <div class="input-group">
                                    <input name="username" type="text" class="form-control form-control-lg" v-model="form.username" />
                                    <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="bx bx-user text-4"></i>
                                </span>
                            </span>
                                </div>
                                <small class="text-danger" v-if="errors.username">{{errors.username[0]}}</small>
                            </div>
                            <div class="form-group mb-3">
                                <div class="clearfix">
                                    <label class="float-left">Password</label>
                                </div>
                                <div class="input-group">
                                    <input name="pwd" type="password" class="form-control form-control-lg" v-model="form.password" />
                                    <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="bx bx-lock text-4"></i>
                                </span>
                            </span>
                                </div>
                                <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                </div>
                                <div class="col-sm-4 text-right">
                                    <button type="submit" class="btn btn-primary mt-2">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. All Rights Reserved.</p>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "Login",
    created() {
        if (User.loggedIn()){
            this.$router.push({name: 'home'})
        }
    },
    data() {
        return {
            form: {
                username: null,
                password: null
            },
            errors: {}
        }
    },
    methods: {
        async login() {
            await AxiosWrapper.post({
                url: '/api/auth/login',
                payload: this.form,
                then: ((res) => {
                    User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Bienvenido(a)!'
                    })
                    this.$store.commit('setUpdateUser', true)
                    this.$store.commit('setUserName', res.data.original.name)
                    this.$router.push({name: 'home'})
                    window.location.reload()
                }),
                error: ((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: err.msg
                    })
                }),
                formErrors: (err) => this.errors = err.errors,
            })
        }
    },
}
</script>

<style scoped>

</style>
