// stores/useOrderStore.js
import { defineStore } from 'pinia'
import axios from '../router/api'

export const useOrderStore = defineStore('order', {
    state: () => ({
        order: null
    }),

    actions: {
        // full_course: type = 1, chapter type = 2
        async createFullCourse(courseId) {
            const res = await axios.post('/orders', {
                course_id: courseId,
                type: 1
            })

            this.order = res.data.data
            return res.data.data
        },

        async createChapterOrder(courseId, chapterIds) {
            const res = await axios.post('/orders', {
                course_id: courseId,
                type: 2,
                chapter_ids: chapterIds
            })

            return res.data
        }
    }
})