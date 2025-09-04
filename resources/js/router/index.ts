import { createRouter, createWebHistory } from 'vue-router';
import JobApplication from '@/pages/JobApplication.vue';

const routes = [
    { path: '/', component: JobApplication }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
