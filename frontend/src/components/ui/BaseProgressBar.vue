<template>
  <div class="w-full bg-gray-200 rounded-full h-2.5">
    <div
      class="bg-blue-600 h-2.5 rounded-full transition-all duration-300 ease-out"
      :style="{ width: `${percentage}%` }"
    ></div>
  </div>
  <p v-if="showLabel" class="text-sm text-gray-600 mt-1">{{ percentage }}%</p>
</template>

<script setup lang="ts">
interface Props {
  percentage: number;
  showLabel?: boolean;
}

defineProps<Props>();
</script>