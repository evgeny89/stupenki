import Vue from 'vue';
import VueRouter from 'vue-router';
import Notifications from 'vue-notification';

Vue.use(VueRouter);
Vue.use(Notifications);

import routeList from './router';

const router = new VueRouter({
    mode: 'history',
    routes: routeList
})

import axios from "axios";
axios.interceptors.request.use(function (config) {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    if (!config.headers.ContentType) {
        config.headers.ContentType = `application/json; charset=UTF-8`;
    }
    config.headers.Accept = `application/json`;

    return config;
});

import HomeLayout from './Layuots/HomeLayout.vue';

new Vue({
    router,
    el: '#app',
    components: {HomeLayout},
    data: function () {
        return {
            userToken: null,
        }
    },
    methods: {
        replaceToken: function () {
            this.userToken = localStorage.getItem('token');
        }
    },
    mounted() {
        this.replaceToken();
    }
});
