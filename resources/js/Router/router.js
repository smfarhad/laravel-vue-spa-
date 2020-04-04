import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Login from '../components/auth/Login';
import Logout from '../components/auth/Logout';
import Signup from '../components/auth/Signup';
import Forum from '../components/forum/Forum';
import ReadQuestion from '../components/forum/ReadQuestion';
import CreateQuestion from '../components/forum/CreateQuestion';

import CreateCateory from '../components/category/Create';


const routes = [{
        path: '/login',
        component: Login
    }, {
        path: '/logout',
        component: Logout
    }, {
        path: '/signup',
        component: Signup
    }, {
        path: '/forum',
        component: Forum,
        name: 'forum'
    }, {
        path: '/question/:slung',
        component: ReadQuestion,
        name: 'ReadQuestion'
    }, {
        path: '/ask',
        component: CreateQuestion,
    }, {
        path: '/category',
        component: CreateCateory,
    }

];

const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang: false,
    mode: 'history'
});

export default router;
