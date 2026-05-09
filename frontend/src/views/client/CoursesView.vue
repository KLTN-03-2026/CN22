<!-- src/views/client/CoursesView.vue -->
<script setup>
import { onMounted, ref, computed } from 'vue'
import { useCourseStore } from '../../stores/course.js'
import { useRouter } from 'vue-router'
import CourseCard from '../../components/common/CourseCard.vue'

const courseStore = useCourseStore()
const router = useRouter()

onMounted(() => {
    courseStore.fetchCourses()
})

const goDetail = (slug) => {
    router.push(`/courses/${slug}`)
}
// State for filters
const searchQuery = ref('')
const selectedCategory = ref('')
const selectedLevel = ref('')
const selectedPrice = ref('all') // 'all', 'free', 'paid'
const sortBy = ref('latest') // 'latest', 'popular', 'price-low', 'price-high'

// Computed for filtered and sorted courses
const filteredCourses = computed(() => {
    let result = courseStore.courses.filter(course => {
        // Search
        if (searchQuery.value &&
            !course.title.toLowerCase().includes(searchQuery.value.toLowerCase()) &&
            !course.description.toLowerCase().includes(searchQuery.value.toLowerCase())) {
            return false
        }
        // Price
        if (selectedPrice.value === 'free' && course.price > 0) {
            return false
        }
        if (selectedPrice.value === 'paid' && course.price === 0) {
            return false
        }

        return true
    })

    // Sorting
    result = [...result].sort((a, b) => {
        switch (sortBy.value) {
            case 'popular':
                return (b.enrolled || 0) - (a.enrolled || 0)
            case 'price-low':
                return a.price - b.price
            case 'price-high':
                return b.price - a.price
            case 'latest':
            default:
                return new Date(b.created_at) - new Date(a.created_at)
        }
    })

    return result
})
</script>

<template>
    <div class="bg-indigo-50 px-4 sm:px-6 lg:px-35">
        <!-- Header -->

        <div class="grid grid-cols-2 grid-rows-1 gap-5 py-10">
            <div class="mb-8">
                <h2 class="text-4xl font-bold">Khám phá danh mục khóa học phong phú của chúng tôi</h2>
                <p class="my-4 text-lg text-body">Khai phá tiềm năng của bạn với nhiều khóa học được thiết kế chuyên
                    nghiệp của chúng tôi. Cho dù bạn đang muốn thăng tiến trong sự nghiệp, khám phá những sở thích mới
                    hay trau dồi những kỹ năng giá trị, các khóa học của chúng tôi bao gồm mọi thứ từ công nghệ đến
                    thiết kế, kinh doanh đến phát triển cá nhân.</p>

                <button type="button"
                    class="text-white bg-indigo-700 box-border border border-transparent hover:bg-indigo-800 focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-full text-sm px-8 py-2.5 focus:outline-none">

                    <a href="#" class="inline-flex items-center text-lg font-medium text-white">
                        Bắt đầu học ngay hôm nay!
                        <svg class="w-5 h-5 ms-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </button>

            </div>
            <div class="flex items-center justify-center">
                <img src="https://demos.flyonui.com/templates/assets/img/template-lms/course/book.png" alt="">
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 ">

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input v-model="searchQuery" type="text" placeholder="Tìm kiếm khóa học..."
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
            </div>

            <!-- Filter Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category Filter -->
                <!-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                    <select v-model="selectedCategory"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        <option v-for="category in courseStore.categories" :key="category.id" :value="category.id">{{
                            category.name }}</option>
                    </select>
                </div> -->

                <!-- Level Filter -->
                <!-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trình độ</label>
                    <select v-model="selectedLevel"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        <option value="beginner">Cơ bản</option>
                        <option value="intermediate">Trung bình</option>
                        <option value="advanced">Nâng cao</option>
                    </select>
                </div> -->

                <!-- Price Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Giá</label>
                    <select v-model="selectedPrice"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="all">Tất cả</option>
                        <option value="free">Miễn phí</option>
                        <option value="paid">Trả phí</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                    <select v-model="sortBy"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="latest">Mới nhất</option>
                        <option value="popular">Phổ biến nhất</option>
                        <option value="price-low">Giá thấp đến cao</option>
                        <option value="price-high">Giá cao đến thấp</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Results Info -->
        <div class="flex justify-between items-center mb-6">
            <!-- <p class="text-gray-700">
                <span class="font-medium">{{ filteredCourses.length }}</span> khóa học
            </p> -->
            <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                Xem bộ lọc nâng cao
            </button>
        </div>

        <!-- Loading State -->
        <div v-if="courseStore.loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="i in 6" :key="i" class="bg-white rounded-xl shadow-sm overflow-hidden animate-pulse">
                <div class="h-48 bg-gray-200"></div>
                <div class="p-4">
                    <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/2 mb-2"></div>
                    <div class="h-3 bg-gray-200 rounded w-full mb-2"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div v-else-if="filteredCourses.length === 0" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Không tìm thấy khóa học</h3>
            <p class="mt-1 text-gray-500">Thử điều chỉnh bộ lọc hoặc tìm kiếm khác</p>
        </div>

        <!-- Course Grid -->
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div v-for="course in filteredCourses" :key="course.id" @click="goDetail(course.slug)"
                class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                <CourseCard :course="course" />
            </div>
        </div>
    </div>

</template>
