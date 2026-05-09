<!-- src/components/common/LessonItem.vue -->
<script setup>
defineProps({
    lesson: Object
})

const getStatus = (lesson) => {
    if (!lesson.is_unlocked) return 'locked'
    if (lesson.is_completed) return 'done'
    return 'learning'
}

const emit = defineEmits(['lesson-click'])

const handleClick = () => {
  emit('lesson-click', lesson)
}
</script>

<template>
    <div @click="handleClick" class="flex items-center justify-between p-3 rounded-lg border transition" :class="{
        'opacity-50 cursor-not-allowed': !lesson.is_unlocked,
        'hover:bg-gray-50 cursor-pointer': lesson.is_unlocked
    }">
        <div>
            <p class="text-sm font-medium text-gray-800">
                {{ lesson.title }}
            </p>
        </div>

        <div class="text-sm">
            <span v-if="getStatus(lesson) === 'locked'">🔒</span>
            <span v-else-if="getStatus(lesson) === 'done'">✅</span>
            <span v-else>▶️</span>
        </div>
    </div>
</template>