<template>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200 rounded-2xl shadow-xl p-6">

                <!-- LOADING -->
                <div v-if="isLoading" class="space-y-6 animate-pulse">
                    <div class="h-20 bg-gray-200 rounded-lg"></div>
                    <div class="h-80 bg-gray-200 rounded-lg"></div>
                </div>

                <!-- ERROR -->
                <div v-else-if="error" class="bg-red-100 text-red-700 p-4 rounded-lg">
                    {{ error }}
                </div>

                <!-- CONTENT -->
                <div v-else>
                    <!-- HEADER -->
                    <div
                        class="flex items-center gap-4 mb-8 p-4 rounded-xl bg-gradient-to-r from-indigo-500 to-indigo-600 text-white shadow-md">
                        <img :src="profile.personalInfo.avatar"
                            class="w-16 h-16 rounded-full border-4 border-white object-cover shadow" />
                        <div>
                            <h1 class="text-xl font-bold">{{ profile.personalInfo.name }}</h1>
                            <p class="text-indigo-100 text-sm">{{ profile.personalInfo.email }}</p>
                        </div>
                    </div>
                    <!-- TABS -->
                    <div class="flex gap-2 overflow-x-auto mb-6 pb-2">
                        <button v-for="tab in tabs" :key="tab.key" @click="activeTab = tab.key"
                            class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-300" :class="activeTab === tab.key
                                ? 'bg-indigo-600 text-white shadow-md'
                                : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-100'">
                            {{ tab.label }}
                        </button>
                    </div>

                    <!-- UPDATE ALERT -->
                    <div v-if="updateStatus.message" :class="[
                        'mb-4 p-3 rounded text-sm border shadow-sm',
                        updateStatus.type === 'success'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700'
                    ]">
                        {{ updateStatus.message }}
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                        <div class="lg:col-span-3">
                            <component :is="currentTabComponent" :profile="profile" @update="handleUpdate" />
                        </div>
                        <div class="space-y-6">
                            <!-- Progress -->
                            <div class="bg-white border rounded-xl p-4 shadow-sm">
                                <p class="text-sm text-gray-500 mb-2">Tiến độ học</p>
                                <div class="h-2 bg-gray-200 rounded">
                                    <div class="h-2 bg-indigo-600 rounded"
                                        :style="{ width: profile.learningInfo.overallProgress + '%' }"></div>
                                </div>
                            </div>

                            <!-- Quick stats -->
                            <div class="bg-white border rounded-xl p-4 shadow-sm">
                                <p class="text-sm font-semibold mb-2">Stats</p>
                                <p class="text-xs text-gray-500">Ranking: #{{ profile.assessment.ranking }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useProfileStore } from '../../stores/useProfileStore.js'

import PersonalTab from '../../components/profile/PersonalTab.vue'


const store = useProfileStore()

const LearningTab = {
    props: ['profile']
}

const AssessmentTab = {
    props: ['profile']
}

const PathTab = {
    props: ['profile']
}

const PaymentTab = {
    props: ['profile'],
    emits: ['update']
}

const SettingsTab = {
    props: ['profile'],
    emits: ['update']
}

/* ================= STATE ================= */
const profile = ref(null)
const isLoading = ref(true)
const error = ref(null)
const activeTab = ref('personal')

const updateStatus = ref({
    message: '',
    type: null
})

/* ================= TABS ================= */
const tabs = [
    { key: 'personal', label: 'Cá nhân', component: PersonalTab },
    { key: 'learning', label: 'Học tập', component: LearningTab },
    { key: 'assessment', label: 'Đánh giá', component: AssessmentTab },
    { key: 'path', label: 'Lộ trình', component: PathTab },
    { key: 'payment', label: 'Thanh toán', component: PaymentTab },
    { key: 'settings', label: 'Cài đặt', component: SettingsTab }
]

const currentTabComponent = computed(() => {
    return tabs.find(t => t.key === activeTab.value)?.component
})

/* ================= MOCK API ================= */
function fetchProfileDataFromAPI() {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve({
                personalInfo: {
                    avatar: 'https://via.placeholder.com/150',
                    name: 'Nguyễn Văn Coder',
                    email: 'coder@example.com'
                },
                learningInfo: {
                    level: 'Intermediate',
                    overallProgress: 65,
                    enrolledCourses: [{ id: 1, title: 'Vue.js', progress: 40 }]
                },
                assessment: {
                    ranking: 150,
                    badges: [{ id: 1, name: 'Fast Learner', icon: '🚀' }]
                },
                personalizedPath: {
                    recommendedPath: 'Fullstack',
                    nextLesson: { title: 'Node.js' }
                },
                paymentAccess: {
                    subscriptionStatus: 'Free'
                },
                settings: {
                    notifications: { email: true }
                }
            })
        }, 1000)
    })
}

/* ================= LOAD ================= */
async function loadProfile() {
    try {
        isLoading.value = true

        // !!! NƠI TÍCH HỢP AXIOS THỰC TẾ !!!
        // const res = await axios.get('/profile')

        profile.value = await fetchProfileDataFromAPI()
    } catch {
        error.value = 'Không thể tải dữ liệu'
    } finally {
        isLoading.value = false
    }
}

/* ================= ACTION ================= */
function handleUpdate(type) {
    updateStatus.value = {
        message: `Cập nhật ${type} thành công`,
        type: 'success'
    }
}

onMounted(loadProfile)
</script>