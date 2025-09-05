import { ref, reactive } from 'vue'
import api from '@/lib/api'

interface JobApplication {
    id: number
    name: string
    email: string
    phone: string
    desired_position: string
    resume_path: string
}

interface Pagination {
    current_page: number
    last_page: number
    per_page: number
    total: number
}

interface JobApplicationsState {
    data: JobApplication[]
    pagination: Pagination
    search: string
}

const state = reactive<JobApplicationsState>({
    data: [],
    pagination: {
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0
    },
    search: ''
})

export function useJobApplications() {
    const applications = ref<JobApplication[]>([])
    const search = ref('')
    const pagination = reactive<Pagination>({
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0
    })

    const fetchApplications = async (page = 1) => {
        try {
            const res = await api.get('/api/v1/job-applications', {
                params: { page, search: state.search }
            })

            state.data = res.data.data
            state.pagination = {
                current_page: res.data.meta.current_page,
                last_page: res.data.meta.last_page,
                per_page: res.data.meta.per_page,
                total: res.data.meta.total
            }
        } catch (err) {
            console.error(err)
        }
    }

    const changePage = async (page: number) => {
        if (page < 1 || page > pagination.last_page) return
        await fetchApplications(page)
    }

    const deleteApplication = async (id: number) => {
        if (!confirm('Deseja realmente deletar este currículo?')) return
        try {
            await api.delete(`/api/v1/job-applications/delete/${id}`)
            await fetchApplications(pagination.current_page)
        } catch (err) {
            console.error(err)
        }
    }

    return {
        state,
        applications,
        search,
        pagination,
        fetchApplications,
        changePage,
        deleteApplication
    }
}
