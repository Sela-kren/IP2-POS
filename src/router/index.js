import { createRouter,createWebHistory } from "vue-router";

import dashboard from '../views/dashboard.vue'
import bookshift from '../views/bookshift.vue'
import test from '../views/test.vue'
import orderpage from '../views/orderpage.vue'
import user from '../views/user.vue'

    const routes = [
        {
            path: '/',
            name: 'Dashboard',
            component:dashboard,
        },
        {
            path: '/bookshift',
            name: 'BookShift',
            component:bookshift,
        },
        {
            path:'/order',
            name:'Order',
            component:orderpage,

        },
        {
            path: '/test',
            name: 'Testcomponent',
            component:test,
        },
        {
            path: '/user',
            name:'user',
            component:user,
        }

    ];

const router = Router ();
export default router;
function Router(){
    const router = new createRouter({
        history: createWebHistory(),
        routes,
    });
    return router;
}