/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';



// src/plugins/vuetify.js

window.Vue = require('vue');

import Vuetify from 'vuetify';

import '@fortawesome/fontawesome-free/css/all.css';

// simplemde mark down editor test editor 
import VueSimplemde from 'vue-simplemde';

// markdown VueSimple mde
import md from "marked";
window.md = md;

Vue.use(Vuetify);

//const opts = {}

//export default new Vuetify(opts)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-home', require('./components/AppHome.vue').default);

// Vue Router file 
import router from './Router/router.js';


// Helper class for login
import User from './Helper/User';
window.User = User;

window.EventBus = new Vue();

// console.log('ID : ' + User.id());
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'fa',
        },
    }),
    router
});
