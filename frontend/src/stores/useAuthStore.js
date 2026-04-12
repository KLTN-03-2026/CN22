import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '../router/api.js'  

export const useAuthStore = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token') || null)
    const user = ref(null)
    const role = ref(null)

    const isAuthenticated = computed(() => !!token.value)
    const isAdmin = computed(() => role.value === 'admin')

    // Action: Login thông thường (email/password)
    const login = async (credentials) => {
        const response = await api.post('/auth/login', credentials)
        console.log(response.data);
        
        const { token: newToken, user: userData, role: userRole } = response.data

        token.value = newToken
        user.value = userData
        role.value = userRole

        localStorage.setItem('token', newToken)
        return response.data
    }

    // Register 
    const register = async (userData) => {
        const response = await api.post('/auth/register', userData)
        return response.data
    }

    const fetchUser = async () => {
        if (!token.value) return

        try {
            const response = await api.get('/auth/user')
            user.value = response.data.user
            role.value = response.data.role || response.data.user?.role
        } catch (error) {
            console.error('Fetch user error:', error)
            logout()
            throw error
        }
    }

    const logout = () => {
        token.value = null
        user.value = null
        role.value = null
        localStorage.removeItem('token')
        // Optional: gọi API logout nếu backend cần revoke token
    }

    return {
        token,
        user,
        role,
        isAuthenticated,
        isAdmin,
        login,
        register,
        logout,
        fetchUser
    }
})