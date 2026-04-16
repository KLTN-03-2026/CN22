// stores/useQuizStore.js
import { defineStore } from 'pinia'
import axios from '../router/api'

export const useQuizStore = defineStore('quiz', {
    state: () => ({
        quiz: null,
        answers: {},
        result: null,
        loading: false,
    }),

    actions: {
        async fetchQuiz(lessonId) {
            this.quiz = null
            this.answers = {}
            this.result = null

            const res = await axios.get(`/lessons/${lessonId}/quiz`)
            this.quiz = res.data
        },

        setAnswer(questionId, answerId) {
            this.answers[questionId] = answerId
        },

        async submitQuiz() {
            this.loading = true

            try {
                const payload = {
                    answers: Object.keys(this.answers).map(qId => ({
                        question_id: Number(qId),
                        answer_id: this.answers[qId]
                    }))
                }

                const res = await axios.post(
                    `/quizzes/${this.quiz.id}/submit`,
                    payload
                )

                this.result = res.data.is_passed


                return res.data 

            } finally {
                this.loading = false
            }
        }
    }
})