import {createRouter, createWebHistory} from 'vue-router';

import User from './user';
import Task from './task';

import PageNotFound from '../views/PageNotFound.vue';
import Login from '../views/Login.vue';

const routes = [
    {
        path: '/',
        redirect: 'users'
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/:pathMatch(.*)*',
        component: PageNotFound
    },
    ...User,
    ...Task
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

export default router
