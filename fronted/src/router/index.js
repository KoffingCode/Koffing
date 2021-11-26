import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
		props: true
    },
    {
        path: '/Usuario/:id/edit',
        name: 'Update',
        component: () => import('../views/Update.vue')
    },
    {
        path: '/Usuario/create',
        name: 'Create',
        component: () => import('../views/Create.vue')
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
