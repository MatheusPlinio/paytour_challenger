<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Job Applications</h1>

        <div class="mb-4 flex gap-2">
            <input v-model="search" @input="fetchApplications(1)" type="text" placeholder="Buscar por nome..."
                class="px-3 py-2 border rounded flex-1" />
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Nome</th>
                    <th class="border px-3 py-2 text-left">Email</th>
                    <th class="border px-3 py-2 text-left">Telefone</th>
                    <th class="border px-3 py-2 text-left">Cargo Desejado</th>
                    <th class="border px-3 py-2 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="app in state.data" :key="app.id">
                    <td class="border px-3 py-2">{{ app.name }}</td>
                    <td class="border px-3 py-2">{{ app.email }}</td>
                    <td class="border px-3 py-2">{{ app.phone }}</td>
                    <td class="border px-3 py-2">{{ app.desired_position }}</td>
                    <td class="border px-3 py-2 flex gap-2">
                        <button @click="deleteApplication(app.id)"
                            class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Deletar
                        </button>
                    </td>
                </tr>
                <tr v-if="applications.length === 0">
                    <td colspan="5" class="text-center py-4">Nenhum registro encontrado</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 flex justify-center gap-2">
            <button class="px-3 py-1 rounded border hover:bg-gray-200 cursor-pointer"
                :disabled="pagination.current_page === 1" @click="() => changePage(pagination.current_page - 1)">
                Anterior
            </button>

            <span class="px-3 py-1">{{ pagination.current_page }} / {{ pagination.last_page }}</span>

            <button class="px-3 py-1 rounded border hover:bg-gray-200 cursor-pointer"
                :disabled="pagination.current_page === pagination.last_page"
                @click="() => changePage(pagination.current_page + 1)">
                Próximo
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useJobApplications } from '@/composables/useJobApplications'

const {
    applications,
    search,
    pagination,
    fetchApplications,
    changePage,
    deleteApplication,
    state
} = useJobApplications()

onMounted(() => {
    fetchApplications()
})
</script>