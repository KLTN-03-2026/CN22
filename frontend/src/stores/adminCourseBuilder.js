// src/stores/adminCourseBuilder.js
import { defineStore } from 'pinia'
import { ref } from 'vue'
import apiClient from '../api/axios.js'

export const useAdminCourseBuilderStore = defineStore('adminCourseBuilder', () => {

    const chapters = ref([])
    const loading = ref(false)

    const fetchChapters = async (courseId) => {
        loading.value = true
        try {
            const res = await apiClient.get(`/admin/courses/${courseId}/chapters`)
            chapters.value = res.data
        } finally {
            loading.value = false
        }
    }

    const createChapter = async (courseId, data) => {
        await apiClient.post(`/admin/courses/${courseId}/chapters`, data)
    }

    const updateChapter = async (chapterId, data) => {
        await apiClient.put(`/admin/chapters/${chapterId}`, data)
    }

    const deleteChapter = async (chapterId) => {
        await apiClient.delete(`/admin/chapters/${chapterId}`)
    }

    return {
        chapters,
        loading,
        fetchChapters,
        createChapter,
        updateChapter,
        deleteChapter
    }
})