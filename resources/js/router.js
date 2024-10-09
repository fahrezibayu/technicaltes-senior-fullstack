import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from "vue-router"

const routeInfos = [
    {
        path: "/",
        component: () => import('./views/DesaPage.vue')
    },
    {
        path: "/petani",
        component: () => import('./views/PetaniPage.vue')
    },
    {
        path: "/fasilitator",
        component: () => import('./views/FasilitatorPage.vue')
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routeInfos
})

export default router;
