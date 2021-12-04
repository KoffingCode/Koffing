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
    },
	{
        path: '/admin/mesas',
        name: 'TableView',
        component: () => import('../views/TableView.vue')
	},
	{
        path: '/mesero/mesas',
        name: 'Consultas',
        component: () => import('../views/QuerysWaiter.vue')
	}
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
