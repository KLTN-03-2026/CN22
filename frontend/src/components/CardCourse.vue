<template>
    <div class="relative overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:scale-[1.02] hover:shadow-xl cursor-pointer"
        @click="handleCardClick">
        <!-- Gradient Header -->
        <div class="relative h-32 bg-gradient-to-br  from-blue-500 to-teal-400 p-5">
            <!-- Decorative Lines -->
            <div class="absolute top-0 right-0 h-full w-32 opacity-20">
                <svg viewBox="0 0 100 100" class="h-full w-full">
                    <path d="M0,0 L100,100 M0,20 L80,100 M0,40 L60,100 M0,60 L40,100 M0,80 L20,100" stroke="white"
                        stroke-width="2" fill="none" />
                </svg>
            </div>

            <!-- Course Info -->
            <div class="relative z-10">
                <p class="text-sm font-medium text-white/90">{{ subtitle }}</p>
                <h3 class="mt-1 text-xl font-bold text-white">{{ title }}</h3>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-5">
            <!-- Stats -->
            <div class="flex justify-between text-sm text-gray-600">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>{{ chapters }} Chapters</span>
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>{{ items }} Items</span>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mt-4">
                <div class="flex justify-between text-xs text-gray-600 mb-1">
                    <span>Progress</span>
                    <span>{{ progress }}%</span>
                </div>
                <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-teal-400 transition-all duration-500"
                        :style="{ width: `${progress}%` }"></div>
                </div>
            </div>

            <!-- Play Button -->
            <div class="absolute bottom-4 right-4">
                <button @click.stop="handlePlayClick"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-teal-400 text-white shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-xl">
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

<script setup>
import { defineProps, defineEmits } from 'vue';

// Props
const props = defineProps({
    title: {
        type: String,
        required: true
    },
    subtitle: {
        type: String,
        required: true
    },
    chapters: {
        type: Number,
        default: 0
    },
    items: {
        type: Number,
        default: 0
    },
    progress: {
        type: Number,
        default: 0,
        validator: (value) => value >= 0 && value <= 100
    },
    thumbnail: {
        type: String,
        default: ''
    },
    courseId: {
        type: [String, Number],
        required: true
    }
});

// Emits
const emit = defineEmits(['card-click', 'play-click']);

// Methods
const handleCardClick = () => {

    alert(`Card clicked: ${props.title} (ID: ${props.courseId})`);
    // emit('card-click', {
    //     courseId: props.courseId,
    //     title: props.title
    // });

    // For future router integration (commented out for now)
    // router.push(`/courses/${props.courseId}`);
};

const handlePlayClick = () => {
    emit('play-click', {
        courseId: props.courseId,
        title: props.title
    });

    // For future router integration (commented out for now)
    // router.push(`/courses/${props.courseId}/learn`);
};
</script>