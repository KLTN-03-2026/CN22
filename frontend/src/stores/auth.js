// src/stores/auth.js
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import apiClient from '../api/axios.js'
import { router } from '../router/index.js'

export const useAuthStore = defineStore('auth', () => {
    // State
    const user = ref(null)
    const token = ref(localStorage.getItem('accessToken') || null)
    // const refreshToken = ref(localStorage.getItem('refreshToken') || null)
    const isLoading = ref(false)
    const error = ref(null)
    const isInitialized = ref(false)

    // Getters
    // const isAuthenticated = computed(() => !!token.value && !!user.value)
    const isAuthenticated = computed(() => !!user.value)
    const isAdmin = computed(() => user.value?.role === 'admin')
    const isStudent = computed(() => user.value?.role === 'student')

    // Actions
    const login = async (credentials) => {
        isLoading.value = true
        error.value = null
        try {
            const response = await apiClient.post('/auth/login', credentials)
            console.log(response.data);

            // const { accessToken, refreshToken: newRefreshToken, user: userData } = response.data
            const { accessToken, user: userData } = response.data

            // Lưu vào state + localStorage
            token.value = accessToken
            // refreshToken.value = newRefreshToken
            user.value = userData

            localStorage.setItem('accessToken', accessToken)
            // if (newRefreshToken) localStorage.setItem('refreshToken', newRefreshToken)

            // Redirect về trang trước hoặc trang chủ
            const redirect = router.currentRoute.value.query.redirect || '/'
            await router.push(redirect)

            return response.data
        } catch (err) {
            error.value = err.response?.data?.message || 'Đăng nhập thất bại'
            throw err
        } finally {
            isLoading.value = false
        }
    }

    const register = async (userData) => {
        isLoading.value = true
        error.value = null
        try {
            const response = await apiClient.post('/auth/register', userData)
            return response.data
        } catch (err) {
            error.value = err.response?.data?.message || 'Đăng ký thất bại'
            throw err
        } finally {
            isLoading.value = false
        }
    }

    const logout = () => {
        user.value = null
        token.value = null
        // refreshToken.value = null
        localStorage.removeItem('accessToken')
        // localStorage.removeItem('refreshToken') note
        router.push('/auth/login')
    }

    const fetchUser = async () => {
        if (!token.value) return
        try {
            const response = await apiClient.get('/auth/me')
            user.value = response.data
        } catch (err) {
            console.error('Fetch user failed:', err)
            logout()
        }
    }

    // Khởi tạo auth khi app load (gọi trong main.js hoặc App.vue)
    const initializeAuth = async () => {
        if (isInitialized.value) return
        if (token.value) {
            await fetchUser()
        }
        isInitialized.value = true
    }

    return {
        user,
        token,
        isAuthenticated,
        isAdmin,
        isStudent,
        isLoading,
        error,
        login,
        register,
        logout,
        fetchUser,
        initializeAuth
    }
})