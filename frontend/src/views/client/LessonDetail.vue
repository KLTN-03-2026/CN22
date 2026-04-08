<template>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <!-- Back Button -->
            <button @click="goBack" class="mb-4 text-indigo-600 hover:underline text-sm">
                ← Quay lại
            </button>

            <!-- Error -->
            <div v-if="error" class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
                ❌ {{ error }}
            </div>

            <!-- Loading -->
            <div v-if="isLoading" class="space-y-4">
                <div class="bg-white p-6 rounded-xl shadow animate-pulse">
                    <div class="h-6 bg-gray-300 w-1/3 mb-4"></div>
                    <div class="h-40 bg-gray-300 mb-4"></div>
                    <div class="h-4 bg-gray-300 w-full mb-2"></div>
                    <div class="h-4 bg-gray-300 w-5/6"></div>
                </div>
            </div>

            <!-- Locked -->
            <div v-else-if="!lesson.isUnlocked" class="bg-yellow-100 text-yellow-800 p-6 rounded-xl">
                🔒 Bài học chưa mở khóa. Bạn cần đạt {{ lesson.scoreRequirement }}% ở bài trước.
            </div>

            <!-- Layout -->
            <div v-else :class="['grid gap-6', isSidebarOpen ? 'lg:grid-cols-12' : 'lg:grid-cols-9']">

                <!-- LEFT SIDEBAR -->
                <div v-if="isSidebarOpen"
                    class="lg:col-span-3 bg-white rounded-xl shadow p-4 h-[80vh] overflow-y-auto sticky top-6">

                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold text-gray-800">Nội dung khóa học</h3>
                        <button @click="isSidebarOpen = false" class="text-sm text-gray-500">✖</button>
                    </div>

                    <div v-for="chapter in lesson.courseStructure" :key="chapter.id" class="mb-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">{{ chapter.title }}</p>

                        <div class="space-y-2">
                            <div v-for="item in chapter.lessons" :key="item.id" @click="navigateToLesson(item)" :class="[
                                'p-2 rounded-lg text-sm flex justify-between items-center transition-all',
                                item.id === lesson.id ? 'bg-indigo-100 text-indigo-600' : 'hover:bg-gray-100',
                                !item.isUnlocked && 'opacity-50 cursor-not-allowed'
                            ]">
                                <span>{{ item.title }}</span>
                                <span v-if="item.completed" class="text-green-500">✔</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MAIN CONTENT -->
                <div :class="isSidebarOpen ? 'lg:col-span-5' : 'lg:col-span-5'">
                    <button v-if="!isSidebarOpen" @click="isSidebarOpen = true" class="mb-2 text-sm text-indigo-600">
                        ☰ Mở nội dung
                    </button>

                    <div class="bg-white rounded-xl shadow p-6">
                        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ lesson.title }}</h1>

                        <div class="bg-gray-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-indigo-600 h-3" :style="{ width: lesson.progress.percentage + '%' }"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Tiến độ: {{ lesson.progress.percentage }}%</p>
                    </div>

                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <!-- note -->
                        <iframe class="w-full h-64 md:h-96" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0"
                            allowfullscreen></iframe>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 prose max-w-none">
                        <div v-html="lesson.content"></div>
                    </div>

                </div>

                <!-- RIGHT SIDEBAR -->
                <div :class="isSidebarOpen ? 'lg:col-span-4' : 'lg:col-span-4'">
                    <p v-if="!isSidebarOpen" class="p-4"></p>
                    <div class="bg-white rounded-xl shadow p-4 sticky top-6 space-y-4">

                        <h3 class="text-lg font-semibold text-gray-800">Bài tập</h3>

                        <!-- QUIZ COMPONENT -->
                         <!-- v-if="lesson.exercise?.type === 'quiz'" note v-if="lesson.exercise?.type === 'quiz'" -->
                        <ExerciseQuiz  
                            @submitted="handleQuizResult" />

                        <!-- CODE COMPONENT -->
                         <!-- note -->
                        <!-- <ExerciseCode v-if="lesson.exercise.type === 'code'" @submitted="handleCodeResult" /> -->

                        <!-- RESULT SUMMARY -->
                        <div v-if="exerciseResult" class="text-sm mt-2">
                            <p>Kết quả: {{ exerciseResult.score }}%</p>
                            <p :class="exerciseResult.passed ? 'text-green-600' : 'text-red-600'">
                                {{ exerciseResult.passed ? 'Đạt' : 'Chưa đạt' }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from '../../router/api.js'
import ExerciseQuiz from './ExerciseQuiz.vue'
import ExerciseCode from './ExerciseCode.vue'

const route = useRoute()
const router = useRouter()

const lesson = ref({})
const isLoading = ref(false)
const error = ref(null)
const exerciseResult = ref(null)
const isSidebarOpen = ref(true)

const fetchLessonFromAPI = () => {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve({
                id: 1,
                title: 'Giới thiệu Composition API',
                content: '<h2>1. Giới thiệu</h2><p>Composition API giúp bạn tổ chức code tốt hơn...</p><h2>2. Ví dụ</h2><p>Nội dung dài như LeetCode...</p>',
                videoUrl: 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                isUnlocked: true,
                scoreRequirement: 70,
                progress: { percentage: 40 },
                exercise: {
                    type: 'quiz',
                    questions: [
                        {
                            id: 1,
                            question: 'Vue 3 dùng API nào?',
                            correct: 2,
                            options: [
                                { id: 1, text: 'Options API' },
                                { id: 2, text: 'Composition API' }
                            ]
                        }
                    ]
                },
                courseStructure: [
                    {
                        id: 1,
                        title: 'Chương 1',
                        lessons: [
                            { id: 1, title: 'Intro', isUnlocked: true, completed: false },
                            { id: 2, title: 'Setup', isUnlocked: false, completed: false }
                        ]
                    }
                ]
            },
            )
        }, 1000)
    })
}

const loadLesson = async () => {
    // isLoading.value = true
    error.value = null

    try {
        const { slug, id } = route.params

        const res = await axios.get(`/courses/${slug}/lessons/${id}`)

        lesson.value = res.data
    } catch (e) {
        error.value = 'Không thể tải bài học'
    } finally {
        isLoading.value = false
    }
}

const handleQuizResult = (result) => {
    exerciseResult.value = result

    if (result.passed) {
        // mark current lesson completed
        lesson.value.courseStructure.forEach(ch => {
            ch.lessons.forEach(l => {
                if (l.id === lesson.value.id) {
                    l.completed = true
                }
            })
        })

        // unlock next lesson
        lesson.value.courseStructure.forEach(ch => {
            for (let i = 0; i < ch.lessons.length; i++) {
                if (ch.lessons[i].id === lesson.value.id && ch.lessons[i + 1]) {
                    ch.lessons[i + 1].isUnlocked = true
                }
            }
        })
    }
}

const handleCodeResult = (result) => {
    if (result.passed) {
        unlockNextLesson()
    }
}

const goBack = () => router.back()

const navigateToLesson = (item) => {
    if (!item.isUnlocked) return
    router.push(`/courses/${route.params.slug}/lessons/${item.id}`)
    loadLesson()
}

onMounted(loadLesson)
</script>
