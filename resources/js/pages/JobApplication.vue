<template>
    <div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-md space-y-4">
        <h1 class="text-2xl font-bold text-blue-600">Formulário de Candidatura</h1>

        <form @submit.prevent="submitForm" class="space-y-4" enctype="multipart/form-data">
            <input type="text" v-model="form.name" placeholder="Nome completo" class="border p-2 rounded w-full"
                required />
            <input type="email" v-model="form.email" placeholder="Email" class="border p-2 rounded w-full" required />
            <input type="tel" v-model="form.phone" placeholder="Telefone" class="border p-2 rounded w-full" required />
            <input type="text" v-model="form.desired_position" placeholder="Cargo desejado"
                class="border p-2 rounded w-full" required />

            <select v-model="form.education_level" class="border p-2 rounded w-full cursor-pointer" required>
                <option disabled value="">Escolha o nível de escolaridade</option>
                <option value="fundamental_incompleto">Fundamental Incompleto</option>
                <option value="fundamental_completo">Fundamental Completo</option>
                <option value="medio_incompleto">Médio Incompleto</option>
                <option value="medio_completo">Médio Completo</option>
                <option value="superior_incompleto">Superior Incompleto</option>
                <option value="superior_completo">Superior Completo</option>
                <option value="pos_graduacao">Pós-Graduação</option>
                <option value="mestrado">Mestrado</option>
                <option value="doutorado">Doutorado</option>
            </select>

            <textarea v-model="form.observations" placeholder="Observações (opcional)"
                class="border p-2 rounded w-full"></textarea>

            <input type="file" @change="handleFileUpload" class="border p-2 rounded w-full cursor-pointer" required />

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200 cursor-pointer"
                :disabled="loading">
                {{ loading ? 'Enviando...' : 'Enviar Currículo' }}
            </button>
        </form>

        <p v-if="message" :class="{ 'text-green-600': success, 'text-red-600': !success }">{{ message }}</p>
    </div>
</template>

<script setup lang="ts">
import { useJobApplicationForm } from '@/composables/useJobApplicationForm';

const { form, loading, message, success, handleFileUpload, submitForm } = useJobApplicationForm();
</script>
