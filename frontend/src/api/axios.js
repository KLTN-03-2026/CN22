// src/api/axios.js
import axios from 'axios'

const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api'

const instance = axios.create({
    baseURL: API_URL,
    timeout: 30000, // 30 giây timeout
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
})

// Gắn token tự động Request Interceptor - Attach Token
instance.interceptors.request.use(config => {
    const token = localStorage.getItem('accessToken')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
},
    (error) => Promise.reject(error)
)

// Xử lý lỗi tập trung - Handle 401, refresh token 
instance.interceptors.response.use(
    response => {
        return response
    },
    async (error) => {
        const originalRequest = error.config

        // Nếu lỗi 401 và chưa retry
        if (error.response?.status === 401 && !originalRequest._retry) {
            originalRequest._retry = true

            try {
                // TODO: Gọi refresh token nếu backend hỗ trợ
                // const refreshToken = localStorage.getItem('refreshToken')
                // const res = await axios.post('/auth/refresh', { refreshToken })
                // localStorage.setItem('accessToken', res.data.accessToken)

                // Retry request gốc
                return instance(originalRequest)
            } catch (refreshError) {
                // Refresh thất bại → logout
                const authStore = (await import('../stores/auth.js')).useAuthStore()
                authStore.logout()
                window.location.href = '/auth/login'
                return Promise.reject(refreshError)
            }
        }

        return Promise.reject(error)
    }
)
export default instance