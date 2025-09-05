<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold text-center mb-6">Criar Conta</h1>

      <form @submit.prevent="register" class="space-y-4">
        <input
          v-model="name"
          type="text"
          placeholder="Nome"
          required
          class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200"
        />

        <input
          v-model="email"
          type="email"
          placeholder="Email"
          required
          class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200"
        />

        <input
          v-model="password"
          type="password"
          placeholder="Senha"
          required
          class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200"
        />

        <input
          v-model="passwordConfirmation"
          type="password"
          placeholder="Confirmar Senha"
          required
          class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200"
        />

        <button
          type="submit"
          class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 cursor-pointer"
        >
          Registrar
        </button>
      </form>

      <p v-if="error" class="mt-4 text-sm text-red-600 text-center">{{ error }}</p>

      <p class="mt-6 text-center text-sm">
        Já tem conta?
        <router-link to="/login" class="text-indigo-600 hover:underline">
          Faça login
        </router-link>
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useAuth } from '@/composables/auth/useAuth';

const { name, email, password, passwordConfirmation, error, register } = useAuth()
</script>
