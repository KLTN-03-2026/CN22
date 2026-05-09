<!-- src/components/common/LearningSidebar.vue -->
<script setup>
defineProps({
    course: Object,
    currentLessonId: Number
})

const emit = defineEmits(['select'])
</script>

<template>
    <div class="w-80 border-r bg-white h-screen overflow-y-auto">

        <div class="p-4 font-semibold border-b">
            {{ course.title }}
        </div>

        <div v-for="chapter in course.chapters" :key="chapter.id">

            <div class="px-4 py-2 text-sm text-gray-500">
                {{ chapter.title }}
            </div>

            <div>
                <div v-for="lesson in chapter.lessons" :key="lesson.id"
                    @click="lesson.is_unlocked && emit('select', lesson.id)"
                    class="px-4 py-2 text-sm cursor-pointer flex justify-between" :class="{
                        'bg-indigo-50 text-indigo-600': lesson.id === currentLessonId,
                        'opacity-50 cursor-not-allowed': !lesson.is_unlocked
                    }">
                    <span>{{ lesson.title }}</span>

                    <span v-if="lesson.is_completed">✅</span>
                    <span v-else-if="!lesson.is_unlocked">🔒</span>
                </div>
            </div>
        </div>

    </div>
</template>