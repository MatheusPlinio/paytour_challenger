<template>
    <div class="flex flex-col min-h-screen">
        <header class="flex items-center justify-between bg-indigo-600 text-white px-6 py-4 shadow-md">
            <h1 class="text-lg font-bold">{{ appName }}</h1>

            <nav class="flex items-center space-x-4">
                <router-link v-if="isAuthenticated" to="/" class="hover:underline">
                    Dashboard
                </router-link>
                <router-link to="/trabalhe-conosco" class="hover:underline">
                    Trabalhe Conosco
                </router-link>
                <router-link to="/login" class="hover:underline">
                    Login
                </router-link>
                <router-link to="/register" class="hover:underline">
                    Registrar
                </router-link>
            </nav>
        </header>

        <main class="flex-1 p-6 bg-gray-100">
            <router-view />
        </main>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue"

const appName = import.meta.env.VITE_APP_NAME

const isAuthenticated = ref(false)

onMounted(() => {
    isAuthenticated.value = !!localStorage.getItem("token")
})

const logout = () => {
    localStorage.removeItem("token")
    window.location.href = "/login"
}
</script>
