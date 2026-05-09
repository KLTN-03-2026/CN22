<!-- src/components/common/CourseCard.vue -->
<script setup>
defineProps({
    course: Object
})
</script>

<template>
    <div class="bg-white rounded-xl shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <!-- Thumbnail -->
        <div class="relative">
            <img :src="course.thumbnail" alt="course image" class="w-full h-40 object-cover" />
        </div>

        <!-- Content -->
        <div class="p-4 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-1">
                {{ course.title }}
            </h2>

            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                {{ course.description }}
            </p>

            <!-- Price + Status -->
            <div class="flex items-center justify-between">
                <span class="text-indigo-600 font-bold">
                    <!-- {{ formatCurrency(course.price) }} -->
                    {{ course.price }}
                </span>

                <span :class="course.is_enrolled
                    ? 'bg-green-100 text-green-600'
                    : 'bg-gray-100 text-gray-600'" class="text-xs px-2 py-1 rounded-full">
                    {{ course.is_enrolled ? 'Đã đăng ký' : 'Chưa đăng ký' }}
                </span>
            </div>

            <!-- Progress Bar -->
            <div class="mt-6">
                <div class="flex justify-between text-xs text-gray-600 mb-1">
                    <span>Progress</span>
                </div>
                <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200">
                    <div class="h-full bg-linear-to-r from-indigo-500 to-cyan-400 transition-all duration-500"
                        :style="{ width: `${50}%` }"></div>
                </div>
            </div>

            <!-- Play Button -->
            <div class="absolute bottom-4 right-4">
                <button @click="navigateToDetail(course.slug)"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-linear-to-l from-sky-500 to-indigo-500 text-white shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>