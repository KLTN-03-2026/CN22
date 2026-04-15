<template>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Back -->
            <button @click="router.back()" class="mb-4 text-indigo-600 text-sm hover:underline">
                ← Quay lại
            </button>
            <div v-if="isEnrolled"
                class="mb-4 px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                Bạn đã mở khóa toàn bộ khóa học
            </div>
            <div class="grid lg:grid-cols-12 gap-6">

                <!-- LEFT -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- Course Info -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h1 class="text-2xl font-bold mb-2">{{ course?.title }}</h1>
                        <p class="text-gray-600 mb-4">{{ course?.description }}</p>

                        <!-- Progress -->
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-linear-to-r from-indigo-500 to-cyan-500"
                                :style="{ width: course?.progress + '%' }" />
                        </div>
                    </div>

                    <!-- Expand Controls -->
                    <div class="flex justify-end gap-2 mb-2">
                        <button @click="expandAllChapters"
                            class="px-3 py-1 text-sm bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition">
                            Mở rộng tất cả
                        </button>

                        <button @click="collapseAllChapters"
                            class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">
                            Thu gọn
                        </button>
                    </div>
                    <!-- Loading -->
                    <div v-if="isLoading" class="space-y-4">
                        <div v-for="i in 3" :key="i" class="bg-white p-4 rounded-xl shadow animate-pulse">
                            <div class="h-5 bg-gray-300 rounded w-1/3 mb-3"></div>
                            <div class="h-4 bg-gray-300 rounded w-2/3"></div>
                        </div>
                    </div>
                    <!-- Chapters -->
                    <div v-else>
                        <div v-for="chapter in chapters" :key="chapter.id" class="bg-white rounded-xl shadow mb-2">

                            <!-- Header -->
                            <div @click="toggle(chapter.id)"
                                class="p-5 flex justify-between cursor-pointer hover:bg-gray-50" :class="chapter.is_accessible
                                    ? 'hover:shadow cursor-pointer'
                                    : 'opacity-60 cursor-not-allowed'">

                                <div>
                                    <h2 class="font-semibold">{{ chapter.title }}</h2>
                                    <p class="text-sm text-gray-500">{{ chapter.description }}</p>
                                </div>

                                <div class="flex items-center gap-3">
                                    <span class="text-sm px-3 py-1 rounded-full" :class="chapter.is_accessible
                                        ? 'bg-green-100 text-green-600'
                                        : 'bg-indigo-100 text-indigo-600'">

                                        {{
                                            chapter.is_free
                                                ? 'Miễn phí'
                                                : chapter.is_accessible
                                                    ? 'Đã mở khóa'
                                                    : formatCurrency(chapter.price)
                                        }}
                                    </span>
                                </div>
                            </div>

                            <!-- Lessons -->
                            <transition enter-active-class="transition-all duration-300"
                                leave-active-class="transition-all duration-200" enter-from-class="opacity-0 max-h-0"
                                enter-to-class="opacity-100 max-h-[1000px]"
                                leave-from-class="opacity-100 max-h-[1000px]" leave-to-class="opacity-0 max-h-0">
                                <div v-if="openId === chapter.id" class="px-5 pb-5 space-y-2">

                                    <div v-for="lesson in chapter.lessons" :key="lesson.id" @click="goLesson(lesson)"
                                        class="relative p-3 rounded-lg border flex justify-between items-center transition"
                                        :class="lesson.is_unlocked ? 'hover:shadow cursor-pointer' : 'bg-gray-100 opacity-60'">

                                        <div>
                                            <p class="font-medium">{{ lesson.title }}</p>
                                            <p v-if="!lesson.is_unlocked" class="text-xs text-red-500">
                                                🔒 {{ lesson.unlock_condition }}
                                            </p>
                                        </div>

                                        <span v-if="lesson.is_unlocked">
                                            <div class="absolute bottom-1 right-2">
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
                                        </span>
                                    </div>

                                </div>
                            </transition>
                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-xl shadow p-6 sticky top-6">

                        <div v-if="!isEnrolled">

                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Đăng ký khóa học</h3>

                            <p class="text-sm text-gray-600 mb-4">
                                Tham gia khóa học để mở khóa toàn bộ nội dung và theo dõi tiến độ học tập của bạn.
                            </p>
                            <ul class="mt-4 text-sm text-gray-500 space-y-1">
                                <li>✔ Truy cập trọn đời</li>
                                <li>✔ Học mọi lúc mọi nơi</li>
                            </ul>

                            <p class="mt-2 text-2xl font-bold text-indigo-600 mb-4 ">Giá tiền: {{ formatCurrency(course.price) }}
                            </p>

                            <button @click="buyFull" class="w-full bg-indigo-600 text-white py-2 rounded-lg">
                                Mua toàn khóa
                            </button>

                            <button @click="buyChapter"
                                class="w-full mt-2 border border-indigo-500 text-indigo-600 py-2 rounded-lg">
                                Mua theo chương
                            </button>

                        </div>

                        <div v-else>
                            <h3 class="text-gray-800 font-semibold text-lg mb-2">Đã đăng ký khóa học</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Bạn đã sở hữu khóa học này. Chào mừng bạn quay trở lại!
                            </p>
                            <ul class="mt-4 text-sm text-gray-500 space-y-1">
                                <li>✔ Bạn có quyền truy cập trọn đời</li>
                                <li>✔ Tiến độ học tập của bạn đang được lưu</li>
                            </ul>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Payment Modal -->
        <PaymentModal v-if="showPayment" :orderId="orderId" @close="showPayment = false" @paid="onPaid" />

        <!-- Selected Chapter Modal  -->
        <SelectChapterModal v-if="showSelectChapter" :chapters="chapters" @close="showSelectChapter = false"
            @submit="handleBuyChapters" />

    </div>
</template>
<script setup>
import { onMounted, ref, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { storeToRefs } from 'pinia'

import { useCourseStore } from '../../stores/useCourseStore'
import { useOrderStore } from '../../stores/useOrderStore'
import { usePaymentStore } from '../../stores/usePaymentStore'

import PaymentModal from '../../components/course/PaymentModal.vue'
import SelectChapterModal from '../../components/course/SelectChapterModal.vue'

const route = useRoute()
const router = useRouter()

const courseStore = useCourseStore()
const orderStore = useOrderStore()
const paymentStore = usePaymentStore()

const { course, isLoading } = storeToRefs(courseStore)

const openId = ref(null)
const showPayment = ref(false)
const orderId = ref(null)
const showSelectChapter = ref(false)

const chapters = computed(() => course.value?.chapters || [])
const isEnrolled = computed(() => course.value?.is_enrolled)

const toggle = (id) => {
    openId.value = openId.value === id ? null : id
}

const buyFull = async () => {
    if (!course.value?.id) return

    const order = await orderStore.createFullCourse(course.value.id)
    orderId.value = order.id

    await paymentStore.createQR(orderId.value)

    showPayment.value = true
}

const buyChapter = () => {
    showSelectChapter.value = true
}

const goLesson = (lesson) => {
    if (!lesson.is_unlocked) return
    router.push(`/courses/${route.params.slug}/lessons/${lesson.id}`)
}

const onPaid = async () => {
    showPayment.value = false
    await courseStore.fetchCourse(route.params.slug)
}

const handleBuyChapters = async (chapterIds) => {
    if (!chapterIds.length) return alert('Chọn ít nhất 1 chương')

    const order = await orderStore.createChapterOrder(
        course.value.id,
        chapterIds
    )

    orderId.value = order.data.id

    await paymentStore.createQR(orderId.value)

    showSelectChapter.value = false
    showPayment.value = true
}









onMounted(() => {
    courseStore.fetchCourse(route.params.slug)
})

const formatCurrency = (p) =>
    new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(p || 0)
</script>