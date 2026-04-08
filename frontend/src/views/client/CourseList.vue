<template>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-800">Danh sách khóa học</h1>

                <!-- Search -->
                <input v-model="searchQuery" type="text" placeholder="Tìm kiếm khóa học..."
                    class="w-full md:w-80 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
            </div>

            <!-- Error State -->
            <div v-if="error" class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
                ❌ {{ error }}
            </div>

            <!-- Loading State (Skeleton) -->
            <div v-if="isLoading" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="i in 6" :key="i" class="bg-white rounded-xl shadow p-4 animate-pulse">
                    <div class="w-full h-40 bg-gray-300 rounded-lg mb-4"></div>
                    <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                    <div class="h-3 bg-gray-300 rounded w-full mb-2"></div>
                    <div class="h-3 bg-gray-300 rounded w-5/6 mb-4"></div>
                    <div class="h-4 bg-gray-300 rounded w-1/3"></div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else-if="filteredCourses.length === 0" class="text-center py-16 text-gray-500">
                📭 Không có khóa học nào
            </div>

            <!-- Course List -->
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="course in filteredCourses" :key="course.id"
                    class="bg-white rounded-xl shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <!-- Thumbnail -->
                    <div class="relative">
                        <img :src="course.thumbnail" alt="course image" class="w-full h-40 object-cover" />

                        <!-- Play Button -->
                        <button @click="navigateToDetail(course.slug)"
                            class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-indigo-600 text-white p-3 rounded-full hover:bg-indigo-700 transition">
                                ▶
                            </div>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-1">
                            {{ course.title }}
                        </h2>

                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ course.description }}
                        </p>

                        <!-- Price + Status -->
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">
                                {{ formatPrice(course.price) }}
                            </span>

                            <span :class="course.is_enrolled
                                ? 'bg-green-100 text-green-600'
                                : 'bg-gray-100 text-gray-600'" class="text-xs px-2 py-1 rounded-full">
                                {{ course.is_enrolled ? 'Đã đăng ký' : 'Chưa đăng ký' }}
                            </span>
                        </div>

                        <!-- Action -->
                        <button @click="navigateToDetail(course.slug)"
                            class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                            Xem chi tiết
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from '../../router/api.js'
import { useRouter } from 'vue-router'


const router = useRouter()

const courses = ref([])
const isLoading = ref(false)
const error = ref(null)
const searchQuery = ref('')

const loadData = async () => {
    isLoading.value = true
    error.value = null

    try {
        const res = await axios.get('/courses')
        courses.value = res.data
    } catch (err) {
        error.value = 'Không thể tải dữ liệu. Vui lòng thử lại.'
    } finally {
        isLoading.value = false
    }
}

const filteredCourses = computed(() => {
    return courses.value.filter(course =>
        course.title.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
})

const navigateToDetail = (slug) => {
    console.log(`/courses/${slug}`);
    router.push(`/courses/${slug}`)
}

const formatPrice = (price) => {
    if (!price) return 'Miễn phí'
    return `$${price}`
}

onMounted(() => {
    loadData()
})
</script>
