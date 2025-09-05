import { ref } from 'vue';
import axios from 'axios';

export interface FormDataType {
    name: string;
    email: string;
    phone: string;
    desired_position: string;
    education_level: string;
    observations?: string;
    resume_file?: File | null;
}

export function useJobApplicationForm() {
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
            const response = await axios.post('/api/v1/job-applications/store', data, {
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

    return { form, loading, message, success, handleFileUpload, submitForm };
}
