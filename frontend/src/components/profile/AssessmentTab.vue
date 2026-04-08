<template>
    <BaseCard>
      <p class="font-semibold">Ranking: #{{ profile.assessment.ranking }}</p>

      <div class="mt-4 text-sm text-gray-500">
        <!-- TODO: Add Chart Component Here -->
        Biểu đồ sẽ hiển thị tại đây
      </div>

      <div class="mt-4 flex gap-2 flex-wrap">
        <span v-for="b in profile.assessment.badges"
          :key="b.id"
          class="px-2 py-1 bg-indigo-100 text-indigo-600 rounded text-xs">
          {{ b.icon }} {{ b.name }}
        </span>
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