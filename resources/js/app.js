require('./bootstrap');

import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter)

import {routes} from "./routes";
import store from './store'

import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

import common from "./common";
Vue.mixin(common)

import User from './Helpers/User';
window.User = User

import AxiosWrapper from './Helpers/AxiosWrapper';
window.AxiosWrapper = AxiosWrapper

import Notification from './Helpers/Notification';
window.Notification = Notification

import Swal from "sweetalert2";
window.Swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

Vue.component('mainapp', require('./mainapp').default)

const router = new VueRouter({
    mode: 'history',
    routes,
});

const app = new Vue({
    el: '#app',
    router,
    store
});




