import { createRouter, createWebHistory } from 'vue-router';
import Form from '@/pages/Form.vue';

const routes = [
    { path: '/formulario', component: Form }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
