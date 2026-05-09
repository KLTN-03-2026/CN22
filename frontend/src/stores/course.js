// src/stores/course.js
import { defineStore } from 'pinia'
import { ref } from 'vue'
import apiClient from '../api/axios.js'

export const useCourseStore = defineStore('course', () => {
    const courses = ref([])
    const loading = ref(false)
    const error = ref(null)

    const fetchCourses = async () => {
        loading.value = true
        error.value = null

        try {
            const res = await apiClient.get('/courses')
            courses.value = res.data
        } catch (err) {
            error.value = err.response?.data?.message || 'Không thể tải khóa học'
        } finally {
            loading.value = false
        }
    }

    return {
        courses,
        loading,
        error,
        fetchCourses
    }
})