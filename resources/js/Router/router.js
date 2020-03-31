import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Login from '../components/auth/Login';
import Signup from '../components/auth/Signup';

const routes = [{
        path: '/login',
        component: Login
    }, {
        path: '/signup',
        component: Signup
    }

];

const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang: false,
    mode: 'history'
});

export default router;
