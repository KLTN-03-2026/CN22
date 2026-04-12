<template>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

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
            <div v-else class="grid gap-6 lg:grid-cols-12">

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

                <!-- MAIN CONTENT + BÀI TẬP (đặt chung 1 cột) -->
                <div :class="isSidebarOpen ? 'lg:col-span-9' : 'lg:col-span-12'">

                    <!-- Nút mở sidebar khi bị đóng -->
                    <button v-if="!isSidebarOpen" @click="isSidebarOpen = true"
                        class="mb-4 text-sm text-indigo-600 flex items-center gap-2">
                        ☰ Mở nội dung khóa học
                    </button>

                    <!-- Video / Main Content -->
                    <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                        <iframe class="w-full h-[300px] md:h-[450px] lg:h-[500px]"
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <!-- Nội dung bài học -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h1 class="text-2xl font-bold text-gray-800 mb-4">
                            {{ lesson.order }}{{ lesson.title }}
                        </h1>
                        <div v-html="lesson.content"></div>
                    </div>

                    <!-- ==================== BÀI TẬP - ĐẶT DƯỚI MAIN CONTENT ==================== -->
                    <div class="mt-8">
                        <div class="bg-white rounded-xl shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Bài tập</h3>

                            <!-- QUIZ COMPONENT -->
                            <ExerciseQuiz/>

                            <!-- CODE COMPONENT -->
                            <!-- <ExerciseCode v-if="lesson.exercise?.type === 'code'" @submitted="handleCodeResult" /> -->

                            <!-- Kết quả -->
                            <div v-if="exerciseResult" class="mt-6 p-4 bg-gray-50 rounded-lg text-sm">
                                <p class="font-medium">Kết quả: <span class="font-bold">{{ exerciseResult.score
                                        }}%</span></p>
                                <p :class="exerciseResult.passed ? 'text-green-600' : 'text-red-600'">
                                    {{ exerciseResult.passed ? '✅ Đạt yêu cầu' : '❌ Chưa đạt' }}
                                </p>
                            </div>
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
import { useQuizStore } from '../../stores/useQuizStore'

const quizStore = useQuizStore()
const route = useRoute()
const router = useRouter()

const lesson = ref({})
const isLoading = ref(false)
const error = ref(null)
const exerciseResult = ref(null)
const isSidebarOpen = ref(true)

const loadLesson = async () => {
    isLoading.value = true
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
