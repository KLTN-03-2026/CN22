// src/stores/learning.js
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import apiClient from '../api/axios.js'

export const useLearningStore = defineStore('learning', () => {
    const course = ref(null)
    const currentLesson = ref(null)
    const loading = ref(false)

    const fetchCourse = async (slug) => {
        loading.value = true
        try {
            const res = await apiClient.get(`/courses/${slug}`)
            course.value = res.data
        } finally {
            loading.value = false
        }
    }

    const setCurrentLesson = (lessonId) => {
        for (const chapter of course.value.chapters) {
            const found = chapter.lessons.find(l => l.id == lessonId)
            if (found) {
                currentLesson.value = found
                return
            }
        }
    }

    const markComplete = async () => {
        if (!currentLesson.value) return

        try {
            await apiClient.post(`/lessons/${currentLesson.value.id}/complete`)

            currentLesson.value.is_completed = true

            // unlock next lesson
            const next = getNextLesson()
            if (next) next.is_unlocked = true

        } catch (e) {
            console.error('Complete failed')
        }
    }

    const getNextLesson = () => {
        let found = false

        for (const chapter of course.value.chapters) {
            for (const lesson of chapter.lessons) {
                if (found) return lesson
                if (lesson.id === currentLesson.value.id) {
                    found = true
                }
            }
        }
        return null
    }

    return {
        course,
        currentLesson,
        loading,
        fetchCourse,
        setCurrentLesson,
        markComplete,
        getNextLesson
    }
})