import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeLayout from './Layuots/HomeLayout.vue';

import routeList from './router';

const router = new VueRouter({
    mode: 'history',
    routes: routeList
})

new Vue({
    router,
    el: '#app',
    components: {HomeLayout}
});
