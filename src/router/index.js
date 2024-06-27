import { createRouter, createWebHistory } from 'vue-router';

import dashboard from '../views/dashboard.vue';
import bookshift from '../views/bookshift.vue';
import test from '../views/test.vue';
import orderpage from '../views/orderpage.vue';

import user from '../views/user/user.vue';
import CreateUser from '../views/user/createUser.vue';

import updateP from '../views/Product/updateProduct.vue';
import manage from '../views/manageBook.vue';


import login from '@/views/login.vue';
import product from '@/views/Product/Product'

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: dashboard,
  },
  {
    path: '/bookshift',
    name: 'BookShift',
    component: bookshift,
  },
  {
    path: '/order',
    name: 'Order',
    component: orderpage,
  },
  {
    path: '/test',
    name: 'Testcomponent',
    component: test,
  },
  {
    path: '/login',
    name: 'login',
    component: login,
  },
  {
    path: '/user',
    name: 'user',
    component: user,
    children: [
      {
        path: 'createUser',
        name: 'createUser',
        component: CreateUser,
      }
    ]
  },
  {
    path: '/manage',
    name: 'managebook',
    component: manage,
    children: [
        {
            path: 'update/:id',
            name: 'updateProduct',
            component: updateP,
            props: (route) => ({
                id: route.params.id,
                // Other props as needed
            }),
        },
        {
            path: '',
            component: product,
        },
    ]
  },
//   {
//     path: '/manage/update',
//     name: 'update Prodcut',
//     component: updateP,
//   },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
