Vue.use(VueRouter);

const routes = [{
        // path: '/login',
        // component: Login
    },
    {
        path: '/bar',
        component: Bar
    }
]

const router = new VueRouter({
    routes // short for `routes: routes`
});

export default router;
