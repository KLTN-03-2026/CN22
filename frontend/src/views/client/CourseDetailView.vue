<!-- src/components/common/CourseDetailView.vue -->
<script setup>
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useCourseDetailStore } from '../../stores/courseDetail.js'
import LessonItem from '../../components/common/LessonItem.vue'

const route = useRoute()
const store = useCourseDetailStore()

onMounted(() => {
    store.fetchCourseDetail(route.params.slug)
})

const toggleChapter = (chapter) => {
    chapter.open = !chapter.open
}
const logLesson = (lesson) => {
  console.log('Lesson đã click:', lesson)
}
</script>

<template>
    <div class="max-w-4xl mx-auto px-4 py-6">

        <!-- Loading -->
        <div v-if="store.loading" class="text-center py-10 text-gray-500">
            Đang tải khóa học...
        </div>

        <!-- Error -->
        <div v-else-if="store.error" class="text-center text-red-500">
            {{ store.error }}
        </div>

        <!-- Content -->
        <div v-else-if="store.course">

            <!-- HEADER -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ store.course.title }}
                </h1>

                <!-- Progress -->
                <div class="mt-4">
                    <div class="h-2 bg-gray-200 rounded">
                        <div class="h-2 bg-indigo-500 rounded" :style="{ width: store.course.progress + '%' }"></div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ store.course.progress }}% hoàn thành
                    </p>
                </div>
            </div>

            <!-- ACTION -->
            <div class="mb-6">
                <button v-if="store.course.is_enrolled"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Tiếp tục học
                </button>

                <button v-else class="px-4 py-2 bg-green-600 text-white rounded-lg">
                    Mua khóa học - {{ store.course.price }}đ
                </button>
            </div>

            <!-- CHAPTERS -->
            <div class="space-y-4">
                <div v-for="chapter in store.course.chapters" :key="chapter.id"
                    class="border border-gray-200 rounded-xl overflow-hidden">
                    <!-- Chapter header -->
                    <div class="flex justify-between items-center p-4 bg-gray-50 cursor-pointer"
                        @click="toggleChapter(chapter)">
                        <h2 class="font-semibold text-gray-800">
                            {{ chapter.title }}
                        </h2>

                        <span v-if="!chapter.is_accessible">🔒</span>
                    </div>

                    <!-- Lessons -->
                    <div v-if="chapter.open" class="p-3 space-y-2">
                        <LessonItem v-for="lesson in chapter.lessons" :key="lesson.id" :lesson="lesson" @lesson-click="logLesson"/>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>