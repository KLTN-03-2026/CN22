import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axios from '../router/api.js'

export const useAuthStore = defineStore('auth', () => {
    // State
    const token = ref(localStorage.getItem('token') || null)
    const user = ref(null)
    const role = ref(null)

    // Getters
    const isAuthenticated = computed(() => !!token.value)
    const isAdmin = computed(() => role.value === 'admin')
    const isUser = computed(() => role.value === 'user')

    // Actions
    const login = async (credentials) => {
        try {
            const response = await api.post('/auth/signin', credentials)
            const { token: newToken, user: userData, role: userRole } = response
            console.log(response);
            
            token.value = newToken.
            user.value = userData
            role.value = userRole

            localStorage.setItem('token', newToken)

            return response.data
        } catch (error) {
            console.error('Login error:', error)
            throw error
        }
    }

    const register = async (userData) => {
        try {
            const response = await api.post('/auth/register', userData)
            return response.data
        } catch (error) {
            console.error('Registration error:', error)
            throw error
        }
    }

    const logout = () => {
        token.value = null
        user.value = null
        role.value = null
        localStorage.removeItem('token')
    }

    const fetchUser = async () => {
        if (!token.value) return

        try {
            const response = await api.get('/auth/me')
            user.value = response.data.user
            role.value = response.data.role
        } catch (error) {
            console.error('Fetch user error:', error)
            logout()
        }
    }

    return {
        // State
        token,
        user,
        role,

        // Getters
        isAuthenticated,
        isAdmin,
        isUser,

        // Actions
        login,
        register,
        logout,
        fetchUser
    }
    // actions: {
    //     async fetchUser() {
    //         try {
    //             const res = await axios.get('http://localhost:8000/api/user')
    //             this.user = res.data
    //         } catch (e) {
    //             this.logout()
    //         }
    //     },

    //     login(token) {
    //         this.token = token
    //         this.isAuthenticated = true
    //         localStorage.setItem('token', token)
    //     },

    //     logout() {
    //         this.user = null
    //         this.token = null
    //         this.isAuthenticated = false
    //         localStorage.removeItem('token')
    //     }
    // }
})