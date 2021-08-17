<template>

</template>

<script>
import AppStorage from "../../Helpers/AppStorage";
export default {
    name: "Logout",
    created() {
        this.logout()
    },
    methods: {
        async logout(){
            let token = User.token()
            await AxiosWrapper.post({
                url: '/api/auth/logout',
                authToken: token,
                then: ((res) => {
                    AppStorage.clear()
                    Toast.fire({
                        icon: 'warning',
                        title: res.data.message
                    })
                    this.$store.commit('setUpdateUser', false)
                    this.$store.commit('setUserName', '')
                    this.$router.push({name: '/'})
                }),
                error: ((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: err.msg
                    })
                }),
            })
        }
    }
}
</script>

<style scoped>

</style>
