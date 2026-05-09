<template>
  <div class="bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Nhắc nhở luyện tập</h2>
    <div class="space-y-4">
      <div class="flex items-center space-x-3">
        <div class="bg-blue-100 p-2 rounded-lg">
          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div>
          <p class="text-sm text-gray-600">Lần cuối luyện tập</p>
          <p class="font-medium text-gray-900">{{ reminder.lastPractice }}</p>
        </div>
      </div>
      
      <div class="flex items-center space-x-3">
        <div class="bg-green-100 p-2 rounded-lg">
          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </div>
        <div>
          <p class="text-sm text-gray-600">Luyện tập tiếp theo</p>
          <p class="font-medium text-gray-900">{{ reminder.nextPractice }}</p>
        </div>
      </div>
      
      <div class="flex items-center space-x-3">
        <div class="bg-orange-100 p-2 rounded-lg">
          <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
          </svg>
        </div>
        <div>
          <p class="text-sm text-gray-600">Chuỗi ngày luyện tập</p>
          <p class="font-medium text-gray-900">{{ reminder.practiceStreak }} ngày</p>
        </div>
      </div>
    </div>
    
    <button class="mt-6 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-colors">
      Bắt đầu luyện tập ngay
    </button>
  </div>
</template>

<script setup>
defineProps({
  reminder: Object
})
</script>