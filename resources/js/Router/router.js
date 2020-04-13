import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Parallex from '../components/Parallex.vue';
import Login from '../components/auth/Login';
import Logout from '../components/auth/Logout';
import Signup from '../components/auth/Signup';
import Forum from '../components/forum/Forum';
import ReadQuestion from '../components/forum/ReadQuestion';
import CreateQuestion from '../components/forum/CreateQuestion';

import CreateCateory from '../components/category/Create';


const routes = [{
        path: '/',
        component: Parallex
    }, {
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


{
    /* <template>
      <v-parallax
        dark
        src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="text-center" cols="12">
            <h1 class="display-1 font-weight-thin mb-4">Vuetify.js</h1>
            <h4 class="subheading">Build your application today!</h4>
          </v-col>
        </v-row>
      </v-parallax>
    </template> */
}
