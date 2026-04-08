import { defineStore } from 'pinia'
import axios from '../router/api.js'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem('token') || null,
        isAuthenticated: !!localStorage.getItem('token')
    }),

    actions: {
        async fetchUser() {
            try {
                const res = await axios.get('http://localhost:8000/api/user')
                this.user = res.data
            } catch (e) {
                this.logout()
            }
        },

        login(token) {
            this.token = token
            this.isAuthenticated = true
            localStorage.setItem('token', token)
        },

        logout() {
            this.user = null
            this.token = null
            this.isAuthenticated = false
            localStorage.removeItem('token')
        }
    }
})
