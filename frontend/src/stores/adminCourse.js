// src/stores/adminCourse.js
import { defineStore } from 'pinia'
import { ref } from 'vue'
import apiClient from '../api/axios.js'

export const useAdminCourseStore = defineStore('adminCourse', () => {
    const courses = ref([])
    const loading = ref(false)
    const error = ref(null)

    const fetchCourses = async () => {
        loading.value = true
        try {
            const res = await apiClient.get('/admin/courses')
            courses.value = res.data
        } catch (e) {
            error.value = 'Không thể tải danh sách'
        } finally {
            loading.value = false
        }
    }

    const createCourse = async (data) => {
        return await apiClient.post('/admin/courses', data)
    }

    const updateCourse = async (id, data) => {
        return await apiClient.put(`/admin/courses/${id}`, data)
    }

    const deleteCourse = async (id) => {
        return await apiClient.delete(`/admin/courses/${id}`)
    }

    return {
        courses,
        loading,
        error,
        fetchCourses,
        createCourse,
        updateCourse,
        deleteCourse
    }
})