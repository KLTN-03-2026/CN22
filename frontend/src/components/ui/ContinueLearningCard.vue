<template>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">{{ title }}</h2>
        <div class="space-y-4">
            <div v-for="course in courses" :key="course.id"
                class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                <img :src="course.thumbnail" :alt="course.title" class="w-20 h-20 rounded-lg object-cover" />
                <div class="flex-1">
                    <h3 class="font-medium text-gray-900">{{ course.title }}</h3>
                    <p class="text-sm text-gray-600">{{ course.instructor }}</p>
                    <div class="mt-2">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Tiến độ</span>
                            <span class="text-gray-900 font-medium">{{ course.progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" :style="{ width: course.progress + '%' }"></div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Tiếp theo:</p>
                    <p class="text-sm font-medium text-indigo-600">{{ course.nextLesson }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    courses: Array
})
</script>