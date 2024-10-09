import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from "vue-router"

const routeInfos = [
    {
        path: "/",
        component: () => import('./views/DesasPage.vue')
    },
    {
        path: "/petani",
        component: () => import('./views/PetaniPage.vue')
    },
    {
        path: "/fasilitator",
        component: () => import('./views/FasilitatorPage.vue')
    },
    {
        path: "/targetArea",
        component: () => import('./views/TargetAreaPage.vue')
    },
    {
        path: "/targetAreaDesa",
        component: () => import('./views/TargetAreaDesaPage.vue')
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routeInfos
})

export default router;
