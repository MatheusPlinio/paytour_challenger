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

            <select v-model="form.education_level" class="border p-2 rounded w-full" required>
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

            <input type="file" @change="handleFileUpload" class="border p-2 rounded w-full" required />

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                :disabled="loading">
                {{ loading ? 'Enviando...' : 'Enviar Currículo' }}
            </button>
        </form>

        <p v-if="message" :class="{ 'text-green-600': success, 'text-red-600': !success }">
            {{ message }}
        </p>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';

interface FormDataType {
    name: string;
    email: string;
    phone: string;
    desired_position: string;
    education_level: string;
    observations?: string;
    resume_file?: File | null;
}

const form = ref<FormDataType>({
    name: '',
    email: '',
    phone: '',
    desired_position: '',
    education_level: '',
    observations: '',
    resume_file: null,
});

const loading = ref(false);
const message = ref('');
const success = ref(false);

function handleFileUpload(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        form.value.resume_file = target.files[0];
    }
}

async function submitForm() {
    if (!form.value.resume_file) return;

    loading.value = true;
    message.value = '';
    success.value = false;

    const data = new FormData();
    data.append('name', form.value.name);
    data.append('email', form.value.email);
    data.append('phone', form.value.phone);
    data.append('desired_position', form.value.desired_position);
    data.append('education_level', form.value.education_level);
    if (form.value.observations) data.append('observations', form.value.observations);
    data.append('resume_file', form.value.resume_file);

    try {
        const response = await axios.post('/api/v1/job-applications', data, {
            headers: { 'Content-Type': 'multipart/form-data' },
        });

        message.value = response.data.message;
        success.value = true;

        form.value = {
            name: '',
            email: '',
            phone: '',
            desired_position: '',
            education_level: '',
            observations: '',
            resume_file: null,
        };
    } catch (error: any) {
        message.value = error.response?.data?.message || 'Erro ao enviar currículo';
        success.value = false;
    } finally {
        loading.value = false;
    }
}
</script>
