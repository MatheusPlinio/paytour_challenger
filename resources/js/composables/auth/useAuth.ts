import { ref } from "vue"
import axios from "axios"

interface LoginResponse {
    token: string
    [key: string]: any
}

interface RegisterResponse {
    user: {
        id: number
        name: string
        email: string
    }
    token: string
}

export function useAuth() {
    const name = ref<string>("")
    const email = ref<string>("")
    const password = ref<string>("")
    const passwordConfirmation = ref<string>("")
    const error = ref<string>("")

    const login = async (): Promise<void> => {
        try {
            const res = await axios.post<LoginResponse>(
                import.meta.env.VITE_API_URL + "api/v1/login",
                {
                    email: email.value,
                    password: password.value,
                }
            )

            localStorage.setItem("token", res.data.token)
            window.location.href = "/"
        } catch (err: any) {
            error.value = err.response?.data?.message || "Login falhou"
        }
    }

    const register = async (): Promise<void> => {
        try {
            const res = await axios.post<RegisterResponse>(
                import.meta.env.VITE_API_URL + "api/v1/register",
                {
                    name: name.value,
                    email: email.value,
                    password: password.value,
                    password_confirmation: passwordConfirmation.value,
                }
            )

            localStorage.setItem("token", res.data.token)
            window.location.href = "/"
        } catch (err: any) {
            error.value = err.response?.data?.message || "Registro falhou"
        }
    }

    return {
        name,
        email,
        password,
        passwordConfirmation,
        error,
        login,
        register,
    }
}
