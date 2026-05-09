// src/stores/courseDetail.js
import { defineStore } from 'pinia'
import { ref } from 'vue'
import apiClient from '../api/axios.js'

export const useCourseDetailStore = defineStore('courseDetail', () => {
    const course = ref(null)
    const loading = ref(false)
    const error = ref(null)

    const fetchCourseDetail = async (slug) => {
        loading.value = true
        error.value = null

        try {
            const res = await apiClient.get(`/courses/${slug}`)
            course.value = res.data
        } catch (err) {
            error.value = err.response?.data?.message || 'Không thể tải khóa học'
        } finally {
            loading.value = false
        }
    }

    return {
        course,
        loading,
        error,
        fetchCourseDetail
    }
})