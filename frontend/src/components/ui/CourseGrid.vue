<template>
  <div class="bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-6">{{ title }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div 
        v-for="course in courses"
        :key="course.id"
        class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition-shadow cursor-pointer"
      >
        <img :src="course.thumbnail" :alt="course.title" class="w-full h-40 object-cover" />
        <div class="p-4">
          <h3 class="font-medium text-gray-900">{{ course.title }}</h3>
          <p class="text-sm text-gray-600 mt-1">{{ course.instructor }}</p>
          <div class="flex items-center justify-between mt-3">
            <div class="flex items-center space-x-1">
              <span class="text-yellow-400">⭐</span>
              <span class="text-sm text-gray-600">{{ course.rating }}</span>
            </div>
            <span class="text-sm font-medium text-gray-900">{{ (course.price) }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// import { formatPrice } from '../../utils/format'

defineProps({
  title: String,
  courses: Array
})
</script>