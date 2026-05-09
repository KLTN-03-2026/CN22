<!-- src/views/client/LearningView.vue -->
<script setup>
import { onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useLearningStore } from '../../stores/learning.js'
import LearningSidebar from '../../components/common/LearningSidebar.vue'

const route = useRoute()
const router = useRouter()
const store = useLearningStore()

onMounted(async () => {
    await store.fetchCourse(route.params.slug)
    store.setCurrentLesson(route.params.lessonId)
})

watch(() => route.params.lessonId, (id) => {
    store.setCurrentLesson(id)
})

const goLesson = (lessonId) => {
    router.push(`/learn/${route.params.slug}/${lessonId}`)
}

const handleComplete = async () => {
    await store.markComplete()

    const next = store.getNextLesson()
    if (next) {
        router.push(`/learn/${route.params.slug}/${next.id}`)
    }
}
</script>

<template>
    <div class="flex">

        <!-- SIDEBAR -->
        <LearningSidebar v-if="store.course" :course="store.course" :currentLessonId="store.currentLesson?.id"
            @select="goLesson" />

        <!-- CONTENT -->
        <div class="flex-1 p-6">

            <div v-if="store.loading">Loading...</div>

            <div v-else-if="store.currentLesson">

                <h1 class="text-xl font-bold mb-4">
                    {{ store.currentLesson.title }}
                </h1>

                <!-- VIDEO -->
                <div class="bg-black h-64 mb-4 flex items-center justify-center text-white">
                    Video Player (placeholder)
                </div>

                <!-- DESCRIPTION -->
                <p class="text-gray-600 mb-6">
                    {{ store.currentLesson.description }}
                </p>

                <!-- ACTION -->
                <button @click="handleComplete" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Hoàn thành bài học
                </button>

            </div>

        </div>

    </div>
</template>