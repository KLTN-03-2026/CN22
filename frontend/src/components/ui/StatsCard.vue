<template>
  <div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-600">{{ title }}</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ value }}</p>
      </div>
      <div :class="`${color} text-white p-3 rounded-lg`">
        <span class="text-2xl">{{ icon }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  value: [Number, String],
  icon: String,
  color: String
})
</script>