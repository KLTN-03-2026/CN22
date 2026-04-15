<template>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <button @click="goBack" class="mb-4 text-indigo-600 hover:underline text-sm">
                ← Quay lại
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- LEFT -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- Course Overview -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ course.title }}</h1>
                        <p class="text-gray-600 mb-4">
                            {{ course.description }}
                        </p>
                        <div>
                            <div class="h-3 w-full overflow-hidden rounded-full bg-gray-200">
                                <div class="h-full bg-linear-to-r from-indigo-500 to-cyan-500 transition-all duration-500"
                                    :style="{ width: `${course.progress}%` }"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Hoàn thành: {{ course.progress }}</p>
                        </div>
                    </div>

                    <!-- Expand Controls -->
                    <div class="flex justify-end gap-2">
                        <button @click="expandAllChapters"
                            class="px-3 py-1 text-sm bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition">
                            Mở rộng tất cả
                        </button>

                        <button @click="collapseAllChapters"
                            class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">
                            Thu gọn
                        </button>
                    </div>

                    <!-- Error -->
                    <div v-if="error" class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                        ❌ {{ error }}
                    </div>

                    <!-- Loading -->
                    <div v-if="isLoading" class="space-y-4">
                        <div v-for="i in 3" :key="i" class="bg-white p-4 rounded-xl shadow animate-pulse">
                            <div class="h-5 bg-gray-300 rounded w-1/3 mb-3"></div>
                            <div class="h-4 bg-gray-300 rounded w-2/3"></div>
                        </div>
                    </div>

                    <!-- Empty -->
                    <div v-else-if="chapters.length === 0" class="text-center py-16 text-gray-500">
                        📭 Không có dữ liệu
                    </div>

                    <!-- Chapters -->
                    <div v-else class="space-y-4">
                        <div v-for="chapter in chapters" :key="chapter.id"
                            class="bg-white rounded-xl shadow transition-all duration-300 hover:shadow-lg">

                            <!-- HEADER -->
                            <div @click="toggleChapter(chapter.id)"
                                class="p-6 flex justify-between items-center cursor-pointer hover:bg-gray-50 transition">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800">
                                        {{ chapter.title }}
                                    </h2>
                                    <p class="text-sm text-gray-500">{{ chapter.description }}</p>
                                </div>

                                <div class="flex items-center gap-3">
                                    <span
                                        :class="chapter.is_free ? 'bg-green-100 text-teal' : 'bg-indigo-100 text-indigo-600'"
                                        class="px-3 py-1 rounded-full text-sm">
                                        {{ chapter.is_free ? 'Miễn phí' : formatCurrency(chapter.price) }}
                                    </span>

                                    <svg :class="isOpen(chapter.id) ? 'rotate-180' : ''"
                                        class="w-5 h-5 text-gray-500 transition-transform duration-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>

                            <!-- LESSONS -->
                            <transition enter-active-class="transition-all duration-300"
                                leave-active-class="transition-all duration-200" enter-from-class="opacity-0 max-h-0"
                                enter-to-class="opacity-100 max-h-[1000px]"
                                leave-from-class="opacity-100 max-h-[1000px]" leave-to-class="opacity-0 max-h-0">
                                <div v-if="isOpen(chapter.id)" class="px-6 pb-6 space-y-2">

                                    <div v-for="(lesson, index) in chapter.lessons" :key="lesson.id"
                                        @click.stop="navigateToDetail(lesson.id, lesson.is_unlocked)" :class="[
                                            'relative p-3 rounded-lg border flex justify-between items-center transition-all duration-300',
                                            lesson.is_unlocked
                                                ? 'bg-white hover:shadow-md hover:-translate-y-1 cursor-pointer'
                                                : 'bg-gray-100 opacity-60 cursor-not-allowed'
                                        ]">
                                        <div>
                                            <p class="font-medium text-gray-800 py-2">Bài {{ index + 1 }}: {{
                                                lesson.title
                                                }}</p>
                                            <p class="text-xs text-gray-500"></p>

                                            <p v-if="!lesson.is_unlocked" class="text-xs text-red-500">
                                                🔒 {{ lesson.unlock_condition }}
                                            </p>
                                        </div>

                                        <div class="absolute bottom-2 right-4">
                                            <button
                                                class="flex h-10 w-10 items-center justify-center rounded-full bg-linear-to-l from-sky-500 to-indigo-500 text-white shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </transition>
                        </div>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-xl shadow p-6 sticky top-6">

                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Đăng ký khóa học</h3>

                        <p class="text-sm text-gray-600 mb-4">
                            Tham gia khóa học để mở khóa toàn bộ nội dung và theo dõi tiến độ học tập của bạn.
                        </p>

                        <p class="text-2xl font-bold text-indigo-600 mb-4">{{ formatCurrency(course.price) }}</p>

                        <button @click="enrollCourse"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300">
                            Đăng ký ngay
                        </button>
                        <button @click="openPaymentModal" class="w-full bg-indigo-600 text-white py-2 rounded-lg">
                            Mua khóa học
                        </button>

                        <ul class="mt-4 text-sm text-gray-500 space-y-1">
                            <li>✔ Truy cập trọn đời</li>
                            <li>✔ Học mọi lúc mọi nơi</li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div v-if="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-xl">

            <h2 class="text-lg font-semibold mb-4">
                Chọn hình thức học
            </h2>

            <!-- Option 1: Free -->
            <div @click="startFreeLearning" class="p-4 border rounded-lg mb-3 cursor-pointer hover:bg-gray-50">
                <p class="font-medium">Học thử miễn phí</p>
                <p class="text-sm text-gray-500">Truy cập các chương miễn phí</p>
            </div>

            <!-- Option 2: Full -->
            <div @click="buyFullCourse" class="p-4 border rounded-lg mb-3 cursor-pointer hover:bg-indigo-50">
                <p class="font-medium text-indigo-600">Mua toàn khóa</p>
                <p class="text-sm text-gray-500">Tiết kiệm hơn, mở khóa tất cả</p>
            </div>

            <!-- Option 3: Chapter -->
            <div @click="chooseChapters" class="p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                <p class="font-medium">Mua theo chương</p>
                <p class="text-sm text-gray-500">Chọn nội dung bạn cần</p>
            </div>

            <button @click="closeModal" class="mt-4 w-full text-sm text-gray-500">
                Đóng
            </button>
        </div>
    </div>


    <div v-if="showChapterModal" class="fixed inset-0 bg-black/50 flex items-center justify-center">

        <div class="bg-white w-full max-w-lg p-6 rounded-xl">

            <h2 class="mb-4 font-semibold">Chọn chương</h2>

            <div class="space-y-2 max-h-80 overflow-y-auto">
                <div v-for="chapter in chapters" :key="chapter.id"
                    class="flex justify-between items-center border p-3 rounded">

                    <span>{{ chapter.title }}</span>

                    <input type="checkbox" v-model="selectedChapters" :value="chapter.id" :disabled="chapter.is_free" />
                </div>
            </div>

            <button @click="confirmChapterPayment" class="mt-4 w-full bg-indigo-600 text-white py-2 rounded">
                Thanh toán
            </button>
        </div>
    </div>

    
</template>

<script setup>
import { ref, onMounted, inject } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from '../../router/api.js'

const route = useRoute()
const router = useRouter()
const toaster = inject('toast')


const course = ref({})
const chapters = ref([])
const isLoading = ref(false)
const error = ref(null)

const activeChapterId = ref(null)
const expandAll = ref(false)

const toggleChapter = (id) => {
    if (expandAll.value) return
    activeChapterId.value = activeChapterId.value === id ? null : id
}

const isOpen = (id) => {
    return expandAll.value || activeChapterId.value === id
}

const expandAllChapters = () => {
    expandAll.value = true
    activeChapterId.value = null
}

const collapseAllChapters = () => {
    expandAll.value = false
    activeChapterId.value = null
}

const loadData = async () => {
    isLoading.value = true
    error.value = null

    try {
        const res = await axios.get(`/courses/${route.params.slug}`)
        course.value = res.data
        chapters.value = res.data.chapters

    } catch (e) {
        error.value = e.response?.data?.message || 'Lỗi tải dữ liệu'
    } finally {
        isLoading.value = false
    }
}

const enrollCourse = async () => {
    try {
        const res = await axios.post(`/courses/${course.value.id}/enroll`)

        toaster.success(res.data.message)

        await loadData()

    } catch (err) {
        console.log(err)
    }
}


const navigateToDetail = (id, unlocked) => {
    if (!unlocked) return
    router.push(`/courses/${route.params.slug}/lessons/${id}`)
    console.log('Go lesson', id)
    // router.push(`/lesson/${id}`)
}


const goBack = () => {
    router.back()
}

const formatCurrency = (price) => {
    if (!price) return 'Miễn phí'
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price)
}

onMounted(loadData)
</script>