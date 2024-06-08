import { createRouter,createWebHistory } from "vue-router";

import dashboard from '../pages/main/dashboard'
import { part } from "core-js/core/function";
const routes = [
    {
        name: 'Dashboard',
        part: '/',
        component: dashboard
    }

]

const router = router ();
export default router;
function Router(){
    const router = new createRouter({
        history: createWebHistory(),
        routes,
    });
    return router;
}