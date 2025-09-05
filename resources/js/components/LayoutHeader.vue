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
                <router-link v-if="!isAuthenticated" to="/login" class="hover:underline">
                    Login
                </router-link>
                <router-link v-if="!isAuthenticated" to="/register" class="hover:underline">
                    Registrar
                </router-link>
                <button v-if="isAuthenticated" @click="logout"
                    class="ml-auto bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md cursor-pointer">
                    Sair
                </button>
            </nav>
        </header>

        <main class="flex-1 p-6 bg-gray-100">
            <router-view />
        </main>
    </div>
</template>

<script setup lang="ts">
import api from "@/lib/api"
import { ref, onMounted } from "vue"

const appName = import.meta.env.VITE_APP_NAME

const isAuthenticated = ref(false)

onMounted(() => {
    isAuthenticated.value = !!localStorage.getItem("token")
})

const logout = async () => {
    try {
        await api.post(`${import.meta.env.VITE_API_URL}/api/v1/auth/logout`, {}, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`
            }
        })

        localStorage.removeItem("token")
        window.location.href = "/login"
    } catch (err) {
        console.error("Erro ao deslogar:", err)
        localStorage.removeItem("token")
        window.location.href = "/"
    }
}
</script>
