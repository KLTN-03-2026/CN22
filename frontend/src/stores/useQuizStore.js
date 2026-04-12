import { defineStore } from 'pinia'
import api from '../router/api'

export const useQuizStore = defineStore('quiz', {
    state: () => ({
        quiz: null,
        answers: {},
        testCases: [],
        result: null,
        loading: false,
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
        },


        async fetchQuestion(lessonId) {
            const res = await api.get(`/lessons/${lessonId}/coding`)
            this.question = res.data.question
            this.testCases = res.data.testcases
        },

        async submitCode(code) {
            this.loading = true

            try {
                const res = await api.post(`/code/submit`, {
                    question_id: this.question.id,
                    code
                })

                this.result = res.data
                this.testCases = res.data.testcases

            } catch (e) {
                alert('Lỗi submit')
            } finally {
                this.loading = false
            }
        }
    }
})