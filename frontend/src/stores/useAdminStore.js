// src/stores/admin.js
import { defineStore } from 'pinia'
import { ref, reactive, computed } from 'vue'
import api from '../router/api'

export const useAdminStore = defineStore('admin', () => {
    // State
    const user = ref(null)
    const dashboardStats = reactive({
        totalUsers: 0,
        activeUsers: 0,
        newUsersThisMonth: 0,
        premiumUsers: 0,
        totalCourses: 0,
        activeCourses: 0,
        newCoursesThisMonth: 0,
        revenueThisMonth: 0,
        revenueGrowthPercent: 0,
        completionRate: 0,
        completionRateChange: 0,
        courseGrowthPercent: 0,
        userGrowthPercent: 0
    })

    const loading = reactive({
        dashboard: false,
        users: false,
        courses: false,
        quizzes: false
    })

    // Actions
    const fetchDashboardStats = async () => {
        loading.dashboard = true
        try {
            const response = await api.get('/admin/dashboard/stats')
            Object.assign(dashboardStats, response.data)
        } catch (error) {
            console.error('Error fetching dashboard stats:', error)
            // Use mock data for demo
            Object.assign(dashboardStats, {
                totalUsers: 2456,
                activeUsers: 1892,
                newUsersThisMonth: 156,
                premiumUsers: 342,
                totalCourses: 18,
                activeCourses: 15,
                newCoursesThisMonth: 3,
                revenueThisMonth: 8750000,
                revenueGrowthPercent: 15.3,
                completionRate: 68.5,
                completionRateChange: 5.2,
                courseGrowthPercent: 8.2,
                userGrowthPercent: 12.5
            })
        } finally {
            loading.dashboard = false
        }
    }

    const fetchUsers = async (params = {}) => {
        loading.users = true
        try {
            const response = await api.get('/admin/users', { params })
            return response.data
        } catch (error) {
            console.error('Error fetching users:', error)
            return []
        } finally {
            loading.users = false
        }
    }

    const fetchCourses = async (params = {}) => {
        loading.courses = true
        try {
            const response = await api.get('/admin/courses', { params })
            return response.data
        } catch (error) {
            console.error('Error fetching courses:', error)
            return []
        } finally {
            loading.courses = false
        }
    }

    const fetchQuizzes = async (params = {}) => {
        loading.quizzes = true
        try {
            const response = await api.get('/admin/quizzes', { params })
            return response.data
        } catch (error) {
            console.error('Error fetching quizzes:', error)
            return []
        } finally {
            loading.quizzes = false
        }
    }

    const createUser = async (userData) => {
        try {
            const response = await api.post('/admin/users', userData)
            return response.data
        } catch (error) {
            console.error('Error creating user:', error)
            throw error
        }
    }

    const updateUser = async (id, userData) => {
        try {
            const response = await api.put(`/admin/users/${id}`, userData)
            return response.data
        } catch (error) {
            console.error('Error updating user:', error)
            throw error
        }
    }

    const deleteUser = async (id) => {
        try {
            await api.delete(`/admin/users/${id}`)
            return true
        } catch (error) {
            console.error('Error deleting user:', error)
            throw error
        }
    }

    const createCourse = async (courseData) => {
        try {
            const response = await api.post('/admin/courses', courseData)
            return response.data
        } catch (error) {
            console.error('Error creating course:', error)
            throw error
        }
    }

    const updateCourse = async (id, courseData) => {
        try {
            const response = await api.put(`/admin/courses/${id}`, courseData)
            return response.data
        } catch (error) {
            console.error('Error updating course:', error)
            throw error
        }
    }

    const deleteCourse = async (id) => {
        try {
            await api.delete(`/admin/courses/${id}`)
            return true
        } catch (error) {
            console.error('Error deleting course:', error)
            throw error
        }
    }

    const createQuiz = async (quizData) => {
        try {
            const response = await api.post('/admin/quizzes', quizData)
            return response.data
        } catch (error) {
            console.error('Error creating quiz:', error)
            throw error
        }
    }

    const updateQuiz = async (id, quizData) => {
        try {
            const response = await api.put(`/admin/quizzes/${id}`, quizData)
            return response.data
        } catch (error) {
            console.error('Error updating quiz:', error)
            throw error
        }
    }

    const deleteQuiz = async (id) => {
        try {
            await api.delete(`/admin/quizzes/${id}`)
            return true
        } catch (error) {
            console.error('Error deleting quiz:', error)
            throw error
        }
    }

    // Getters
    const isLoading = computed(() => {
        return Object.values(loading).some(state => state)
    })

    return {
        // State
        user,
        dashboardStats,
        loading,

        // Actions
        fetchDashboardStats,
        fetchUsers,
        fetchCourses,
        fetchQuizzes,
        createUser,
        updateUser,
        deleteUser,
        createCourse,
        updateCourse,
        deleteCourse,
        createQuiz,
        updateQuiz,
        deleteQuiz,

        // Getters
        isLoading
    }
})