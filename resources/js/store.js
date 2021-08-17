import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: false,
        userName: '',
        userPermission: null,
    },
    plugins: [
        createPersistedState({
            storage: window.sessionStorage,
        })
    ],
    getters: {
        getUserPermission(state){
            return state.userPermission
        },
    },
    mutations: {
        setUpdateUser(state, data){
            state.user = data
        },
        setUserName(state, data){
            state.userName = data
        },
        setUserPermission(state, data){
            state.userPermission = data
        },
    },
    actions: {

    }
})
