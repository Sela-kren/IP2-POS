import { createRouter, createWebHistory } from 'vue-router';

import dashboard from '../views/dashboard.vue';
import bookshift from '../views/bookshift.vue';
import test from '../views/test.vue';
import orderpage from '../views/orderpage.vue';

import user from '../views/user/user.vue';
import CreateUser from '../views/user/createUser.vue';
import UpdateUser from '@/views/user/updateUser.vue';

import updateP from '../views/Product/updateProduct.vue';
import manage from '../views/manageBook.vue';
import createProduct from '@/views/Product/createProduct.vue';

import login from '@/views/login.vue';
import product from '@/views/Product/Product'
import manageUser from '@/views/manageUser.vue';
import User from '../views/user/user.vue';


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
    component: manageUser,
    children: [
      {
        path: 'createUser',
        name: 'createUser',
        component: CreateUser,
      },
      {
        path: '',
        name: 'user',
        component: User,
      },
      {
        path: 'updateUser/:id',
        name: 'updateUser',
        component: UpdateUser,
        props: (route) => ({
          id: route.params.id,
          // Other props as needed
      }),
      },
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
        {
          path: 'create',
          component: createProduct,
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
