import { createRouter, createWebHistory } from "vue-router";
import store from '../store'

const routes = [
    {
        name:"login",
        path:"/login",
        component: import('../view/auth/login.vue'),
        meta:{
            middleware:"guest",
            title:`Login`
        }
    },
    {
        name:"campaigns2",
        path:"/campaigns2",
        component: import('../view/dashboard/campaigns.vue'),
        meta:{
            middleware:"guest",
            title:`campaigns`
        }
    },
    // {
    //     name:"register",
    //     path:"/register",
    //     component:Register,
    //     meta:{
    //         middleware:"guest",
    //         title:`Register`
    //     }
    // },
    {
        path:"/",
        component:import('../components/layouts/Dashboard.vue'),
        meta:{
            middleware:"auth"
        },
        children:[
            {
                name:"dashboard",
                path: '/',
                component: import('../view/dashboard/Dashboard.vue'),
                meta:{
                    title:`Dashboard`
                }
            },
            {
                name:"campaigns",
                path: '/campaigns',
                component: import('../view/dashboard/campaigns.vue'),
                meta:{
                    title:`Dashboard`
                }
            }
        ]
    },
    {
        path: "/:catchAll(.*)",
        component: import('../view/404.vue'),
    },
]
const history =
    // createMemoryHistory();
    createWebHistory();

const router  = createRouter({
    history: history,
    routes: routes,
});

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title}`// - ${process.env.MIX_APP_NAME}`
    if(to.meta.middleware=="guest"){
        if(store.state.auth.authenticated){
            next({name:"dashboard"})
        }
        next()
    }else{
        if(store.state.auth.authenticated){
            next()
        }else{
            next({name:"login"})
        }
    }
})
export default router;