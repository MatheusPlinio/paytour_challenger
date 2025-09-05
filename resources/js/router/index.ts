import { createRouter, createWebHistory } from 'vue-router';
import JobApplication from '@/pages/JobApplication.vue';
import Login from '@/pages/auth/Login.vue';
import Dashboard from '@/pages/Dashboard.vue';
import Register from '@/pages/auth/Register.vue';
import LayoutHeader from '@/components/LayoutHeader.vue';

const routes = [
    {
        path: "/",
        component: LayoutHeader,
        children: [
            { path: "", component: Dashboard, meta: { requiresAuth: true } },
            { path: "/login", component: Login },
            { path: "/register", component: Register },
            { path: '/trabalhe-conosco', component: JobApplication }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token")
    if (to.meta.requiresAuth && !token) {
        next("/login")
    } else {
        next()
    }
})

export default router;
