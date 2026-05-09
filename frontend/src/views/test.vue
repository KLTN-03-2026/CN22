<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useCourseDetailStore } from '../stores/courseDetail.js'

const route = useRoute()
const router = useRouter()
const courseStore = useCourseDetailStore()

const course = {
    "title": "Vue.js từ A đến Z",
    "slug": "vue-js-a-to-z",
    "description": "Khóa học Vue.js toàn diện từ cơ bản đến nâng cao",
    "thumbnail": "/thumbnails/vue-course.jpg",
    "price": 499000,
    "originalPrice": 799000,
    "duration": "12 giờ",
    "lessons": 25,
    "students": 1245,
    "rating": 4.7,
    "reviews": 156,
    "instructor": {
        "name": "Nguyễn Văn A",
        "title": "Senior Frontend Developer",
        "avatar": "/instructors/instructor1.jpg"
    },
    "content": "<p>Khóa học này sẽ giúp bạn nắm vững kiến thức về Vue.js...</p>",
    "whatYouLearn": [
        "Cơ bản về Vue.js",
        "Components và Props",
        "Vue Router",
        "Vuex/Pinia",
        "SSR với Nuxt.js"
    ],
    "targetAudience": "Developer JavaScript muốn học Vue.js",
    "sections": [
        {
            "id": 1,
            "title": "Giới thiệu",
            "lessons": [
                { "id": 1, "title": "Chào mừng đến với khóa học", "duration": "5:30" },
                { "id": 2, "title": "Cài đặt môi trường", "duration": "8:20" }
            ]
        },
        {
            "id": 2,
            "title": "Vue.js cơ bản",
            "lessons": [
                { "id": 3, "title": "Hello Vue", "duration": "12:45" },
                { "id": 4, "title": "Template Syntax", "duration": "15:30" }
            ]
        }
    ],
    "reviews": [
        {
            "id": 1,
            "user": {
                "name": "Trần Thị B",
                "avatar": "/users/user1.jpg"
            },
            "date": "2024-01-15",
            "content": "Khóa học rất chi tiết, dễ hiểu!"
        }
    ],
    "relatedCourses": [
        {
            "id": 2,
            "slug": "react-js-complete",
            "title": "React.js Complete",
            "thumbnail": "/thumbnails/react-course.jpg",
            "price": 599000,
            "rating": 4.8,
            "instructor": {
                "name": "Lê Văn C"
            }
        }
    ]
}
const loading = ref(true)
const error = ref(null)

// Tab states
const activeTab = ref('overview')

onMounted(async () => {
    try {
        loading.value = true
        const slug = route.params.slug
        await courseStore.fetchCourseDetail(slug)
        course.value = courseStore.currentCourse
    } catch (err) {
        error.value = 'Không tìm thấy khóa học'
        console.error(err)
    } finally {
        loading.value = false
    }
})

const handleEnroll = () => {
    // Logic đăng ký khóa học
    router.push('/checkout')
}

const handleAddToCart = () => {
    // Logic thêm vào giỏ hàng
    // ...
}
</script>

<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <router-link to="/" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span class="sr-only">Trang chủ</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/courses" class="text-gray-500 hover:text-gray-700">Khóa học</router-link>
                </li>
                <li>
                    <span class="text-gray-500" aria-current="page">Chi tiết</span>
                </li>
            </ol>
        </nav>

        <!-- Loading State -->
        <div v-if="loading" class="animate-pulse">
            <div class="bg-gray-200 h-64 rounded-lg mb-6"></div>
            <div class="h-8 bg-gray-200 rounded w-3/4 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2 mb-6"></div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-200 h-48 rounded-lg"></div>
                <div class="bg-gray-200 h-48 rounded-lg"></div>
                <div class="bg-gray-200 h-48 rounded-lg"></div>
            </div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">{{ error }}</h3>
            <p class="mt-1 text-gray-500">Vui lòng quay lại trang danh sách</p>
        </div>

        <!-- Course Detail -->
        <div v-else-if="course" class="space-y-8">
            <!-- Hero Section -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6">
                    <!-- Video Preview -->
                    <div class="lg:col-span-2">
                        <div class="relative aspect-video bg-gray-100 rounded-lg overflow-hidden">
                            <img :src="course.thumbnail" :alt="course.title" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button
                                    class="bg-white bg-opacity-90 rounded-full p-4 hover:bg-opacity-100 transition-all">
                                    <svg class="h-12 w-12 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ course.title }}</h1>
                            <p class="mt-2 text-gray-600">{{ course.description }}</p>
                        </div>

                        <!-- Meta Info -->
                        <div class="flex items-center space-x-6 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ course.duration || '12 giờ' }}
                            </div>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                {{ course.lessons || 20 }} bài học
                            </div>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                {{ course.students || 1.2 }} học viên
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center">
                            <div class="flex">
                                <svg v-for="i in 5" :key="i" class="h-5 w-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-gray-600">{{ course.rating || 4.5 }} ({{ course.reviews ||
                                128 }} đánh giá)</span>
                        </div>

                        <!-- Price -->
                        <div class="border-t pt-4">
                            <div class="flex items-baseline">
                                <span class="text-3xl font-bold text-gray-900">{{ formatPrice(course.price) }}</span>
                                <span v-if="course.originalPrice" class="ml-2 text-lg text-gray-500 line-through">{{
                                    formatPrice(course.originalPrice) }}</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Giảm {{ calculateDiscount(course.originalPrice,
                                course.price) }}%</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4">
                            <button @click="handleEnroll"
                                class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                                Đăng ký ngay
                            </button>
                            <button @click="handleAddToCart"
                                class="flex-1 bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>

                        <!-- Instructor Info -->
                        <div class="flex items-center space-x-3 pt-4 border-t">
                            <img :src="course.instructor.avatar" :alt="course.instructor.name"
                                class="h-12 w-12 rounded-full object-cover" />
                            <div>
                                <p class="text-sm font-medium text-gray-900">Giảng viên: {{ course.instructor.name }}
                                </p>
                                <p class="text-sm text-gray-500">{{ course.instructor.title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button v-for="tab in ['overview', 'curriculum', 'reviews']" :key="tab" @click="activeTab = tab"
                            :class="[
                                'py-4 px-1 border-b-2 font-medium text-sm',
                                activeTab === tab
                                    ? 'border-indigo-500 text-indigo-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                            ]">
                            {{ getTabName(tab) }}
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Overview Tab -->
                    <div v-show="activeTab === 'overview'" class="prose max-w-none">
                        <h3 class="text-lg font-semibold mb-4">Giới thiệu khóa học</h3>
                        <div v-html="course.content"></div>

                        <h3 class="text-lg font-semibold mt-8 mb-4">Bạn sẽ học được gì</h3>
                        <ul class="space-y-2">
                            <li v-for="(item, index) in course.whatYouLearn" :key="index" class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                {{ item }}
                            </li>
                        </ul>

                        <h3 class="text-lg font-semibold mt-8 mb-4">Đối tượng phù hợp</h3>
                        <p>{{ course.targetAudience }}</p>
                    </div>

                    <!-- Curriculum Tab -->
                    <div v-show="activeTab === 'curriculum'">
                        <div v-for="section in course.sections" :key="section.id" class="mb-6">
                            <h3 class="text-lg font-semibold mb-4">{{ section.title }}</h3>
                            <div class="space-y-3">
                                <div v-for="lesson in section.lessons" :key="lesson.id"
                                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ lesson.title }}</span>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ lesson.duration }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Tab -->
                    <div v-show="activeTab === 'reviews'">
                        <div class="mb-6">
                            <div class="flex items-center">
                                <div class="flex">
                                    <svg v-for="i in 5" :key="i" class="h-5 w-5 text-yellow-400" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <span class="ml-2 text-lg font-medium">{{ course.rating || 4.5 }}</span>
                                <span class="ml-1 text-gray-500">({{ course.reviews || 128 }} đánh giá)</span>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div v-for="review in course.reviews" :key="review.id"
                                class="border-b pb-6 last:border-0 last:pb-0">
                                <div class="flex items-start space-x-3">
                                    <img :src="review.user.avatar" :alt="review.user.name"
                                        class="h-10 w-10 rounded-full object-cover" />
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-medium text-gray-900">{{ review.user.name }}</h4>
                                            <span class="text-sm text-gray-500">{{ review.date }}</span>
                                        </div>
                                        <div class="flex mt-1">
                                            <svg v-for="i in 5" :key="i" class="h-4 w-4 text-yellow-400"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <p class="mt-2 text-gray-700">{{ review.content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Courses -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Khóa học liên quan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div v-for="related in course.relatedCourses" :key="related.id"
                        @click="router.push(`/courses/${related.slug}`)"
                        class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                        <img :src="related.thumbnail" :alt="related.title" class="w-full h-48 object-cover" />
                        <div class="p-4">
                            <h3 class="font-medium text-gray-900">{{ related.title }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ related.instructor.name }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="font-medium text-gray-900">{{ formatPrice(related.price) }}</span>
                                <span class="text-sm text-gray-500">{{ related.rating }} ⭐</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price)
        },
        calculateDiscount(original, current) {
            if (!original) return 0
            return Math.round(((original - current) / original) * 100)
        },
        getTabName(tab) {
            const names = {
                overview: 'Giới thiệu',
                curriculum: 'Chương trình học',
                reviews: 'Đánh giá'
            }
            return names[tab] || tab
        }
    }
}
</script>