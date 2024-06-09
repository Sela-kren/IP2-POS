import { createRouter,createWebHistory } from "vue-router";

import dashboard from '../views/dashboard.vue'
import bookshift from '../views/bookshift.vue'

    const routes = [
        {
            path: '/',
            name: 'Dashboard',
            component:dashboard
        },
        {
            path: '/bookshift',
            name: 'BookShift',
            component:bookshift
        },
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