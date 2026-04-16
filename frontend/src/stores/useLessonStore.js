// stores/useLessonStore.js
import { defineStore } from 'pinia'
import axios from '../router/api'

export const useLessonStore = defineStore('lesson', {
    state: () => ({
        lesson: {},
        loading: false,
        error: null,
        currentLessonId: null,
    }),

    actions: {
        async fetchLesson(slug, id) {
            this.loading = true
            this.error = null
            this.currentLessonId = id

            try {
                const res = await axios.get(`/courses/${slug}/lessons/${id}`)
                this.lesson = res.data
            } catch (e) {
                this.error = e.response?.data?.error || 'Lỗi tải bài học'
            } finally {
                this.loading = false
            }
        },

        async refresh() {
            if (!this.currentLessonId) return

            await this.fetchLesson(
                window.location.pathname.split('/')[2],
                this.currentLessonId
            )
        }
    }
})