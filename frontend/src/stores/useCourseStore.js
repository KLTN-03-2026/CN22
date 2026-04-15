// stores/useCourseStore.js
import { defineStore } from 'pinia'
import axios from '../router/api'

export const useCourseStore = defineStore('course', {
  state: () => ({
    course: {},
    chapters: [],
    loading: false,
    error: null
  }),

  actions: {
    async fetchCourse(slug) {
      this.loading = true
      this.error = null

      try {
        const res = await axios.get(`/courses/${slug}`)
        this.course = res.data
        // console.log(this.course);
        
        this.chapters = res.data.chapters
      } catch (e) {
        this.error = e.response?.data?.message || 'Lỗi tải dữ liệu'
      } finally {
        this.loading = false
      }
    }
  }
})