<script setup>
import { ref, onMounted } from 'vue'
import ContinueLearningCard from '../components/ui/ContinueLearningCard.vue'
import PracticeReminderCard from '../components/ui/PracticeReminderCard.vue'
import StatsCard from '../components/ui/StatsCard.vue'
import CourseGrid from '../components/ui/CourseGrid.vue'

// Mock data
const userData = {
    name: 'Nguyễn Văn A',
    avatar: 'https://via.placeholder.com/150',
    email: 'nguyena@example.com',
    joinDate: '2023-01-15'
}

const statsData = {
    totalCourses: 12,
    completedCourses: 5,
    currentStreak: 7,
    totalHours: 45
}

const practiceReminderData = {
    lastPractice: '2 ngày trước',
    nextPractice: 'Hôm nay, 14:00',
    practiceStreak: 5
}

const coursesData = {
    enrolled: [
        {
            id: 1,
            title: 'Vue.js từ A đến Z',
            instructor: 'Nguyễn Văn B',
            progress: 65,
            thumbnail: 'https://via.placeholder.com/300x200',
            nextLesson: 'Bài 5: Components',
            duration: '12 giờ',
            enrolledDate: '2024-01-01'
        },
        {
            id: 2,
            title: 'React.js Masterclass',
            instructor: 'Trần Thị C',
            progress: 30,
            thumbnail: 'https://via.placeholder.com/300x200',
            nextLesson: 'Bài 3: State Management',
            duration: '15 giờ',
            enrolledDate: '2024-01-10'
        }
    ],
    recommended: [
        {
            id: 3,
            title: 'Node.js Backend Development',
            instructor: 'Lê Văn D',
            price: 999000,
            rating: 4.8,
            thumbnail: 'https://via.placeholder.com/300x200',
            students: 2450
        },
        {
            id: 4,
            title: 'UI/UX Design Fundamentals',
            instructor: 'Phạm Thị E',
            price: 799000,
            rating: 4.6,
            thumbnail: 'https://via.placeholder.com/300x200',
            students: 1890
        }
    ]
}

// Lazy loading states
const continueLearningLoaded = ref(false)
const courseGridLoaded = ref(false)

// Simulate lazy loading
onMounted(() => {
    setTimeout(() => {
        continueLearningLoaded.value = true
    }, 1000)

    setTimeout(() => {
        courseGridLoaded.value = true
    }, 1500)
})
</script>

<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <img :src="userData.avatar" :alt="userData.name" class="w-16 h-16 rounded-full object-cover" />
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Chào mừng, {{ userData.name }}!</h1>
                    <p class="text-gray-600">Tham gia từ {{ userData.joinDate }}</p>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <StatsCard title="Khóa học" :value="statsData.totalCourses" icon="📚" color="bg-blue-500" />
            <StatsCard title="Hoàn thành" :value="statsData.completedCourses" icon="✅" color="bg-green-500" />
            <StatsCard title="Chuỗi ngày" :value="statsData.currentStreak" icon="🔥" color="bg-orange-500" />
            <StatsCard title="Giờ học" :value="statsData.totalHours" icon="⏱️" color="bg-purple-500" />
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Continue Learning Card -->
                <div v-if="continueLearningLoaded">
                    <ContinueLearningCard :courses="coursesData.enrolled" title="Tiếp tục học" />
                </div>
                <div v-else class="animate-pulse">
                    <div class="bg-gray-200 rounded-xl h-64"></div>
                </div>

                <!-- Course Grid -->
                <div v-if="courseGridLoaded">
                    <CourseGrid :courses="coursesData.recommended" title="Khóa học đề xuất" />
                </div>
                <div v-else class="animate-pulse">
                    <div class="bg-gray-200 rounded-xl h-96"></div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Practice Reminder Card -->
                <PracticeReminderCard :reminder="practiceReminderData" />

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Hành động nhanh</h3>
                    <div class="space-y-3">
                        <button
                            class="w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-900">📖 Xem lịch học</span>
                        </button>
                        <button
                            class="w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-900">🏆 Thành tích của tôi</span>
                        </button>
                        <button
                            class="w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-900">⚙️ Cài đặt</span>
                        </button>
                    </div>
                </div>

                <!-- Learning Goals -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Mục tiêu học tập</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Hoàn thành 10 khóa học</span>
                                <span class="text-gray-900 font-medium">5/10</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: 50%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Học 100 giờ</span>
                                <span class="text-gray-900 font-medium">45/100</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>