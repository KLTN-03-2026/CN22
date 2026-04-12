import { defineStore } from 'pinia'
import api from '../router/api'

export const useQuizStore = defineStore('quiz', {
    state: () => ({
        quiz: null,
        answers: {},
        result: null,
        loading: false
    }),

    actions: {
        async fetchQuiz(lessonId) {
            const res = await api.get(`/lessons/${lessonId}/quiz`)
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

                const res = await api.post(
                    `/quizzes/${this.quiz.id}/submit`,
                    payload
                )

                this.result = res.data

            } finally {
                this.loading = false
            }
        }
    }
})