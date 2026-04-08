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

// Gắn token tự động
instance.interceptors.request.use(config => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})

// Xử lý lỗi tập trung
instance.interceptors.response.use(
    response => {
        return response
    },
    error => {
        // Xử lý token hết hạn
        if (error.response?.status === 401) {
            localStorage.removeItem('token')
            window.location.href = '/signin'
        }
        return Promise.reject(error)
    }
)
export default instance