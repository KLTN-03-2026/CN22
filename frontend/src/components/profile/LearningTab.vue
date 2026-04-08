<template>
    <BaseCard>
      <p class="text-sm text-gray-600">Level: {{ profile.learningInfo.level }}</p>

      <div class="mt-4">
        <div class="h-2 bg-gray-200 rounded">
          <div class="h-2 bg-indigo-600 rounded"
            :style="{ width: profile.learningInfo.overallProgress + '%' }"></div>
        </div>
        <p class="text-xs text-gray-500 mt-1">
          {{ profile.learningInfo.overallProgress }}%
        </p>
      </div>

      <div class="mt-6">
        <h3 class="font-semibold mb-2">Đang học</h3>

        <div v-if="!profile.learningInfo.enrolledCourses.length"
          class="text-sm text-gray-500">
          Không có dữ liệu
        </div>

        <div v-for="c in profile.learningInfo.enrolledCourses" :key="c.id"
          class="text-sm mb-1">
          {{ c.title }} ({{ c.progress }}%)
        </div>
      </div>
    </BaseCard>
</template>
<script setup>
import { ref, computed, onMounted } from 'vue'
import { useProfileStore } from '../../stores/useProfileStore.js'
import BaseCard from './BaseCard.vue'

</script>
<style>
    
</style>