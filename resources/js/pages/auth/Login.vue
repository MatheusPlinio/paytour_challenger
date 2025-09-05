<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-100">
        <div>

        </div>
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h1>

            <form @submit.prevent="login" class="space-y-4">
                <div>
                    <input v-model="email" type="email" placeholder="Email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div>
                    <input v-model="password" type="password" placeholder="Senha" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200 cursor-pointer">
                    Entrar
                </button>
            </form>

            <p class="mt-6 text-center text-sm">
                Não tem conta?
                <router-link to="/register" class="text-indigo-600 hover:underline">
                    Faça Registro
                </router-link>
            </p>

            <p v-if="error" class="mt-4 text-center text-red-600 font-medium">
                {{ error }}
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAuth } from '@/composables/auth/useAuth';

const { email, password, error, login } = useAuth()
</script>
