<template>
    <BaseCard>
      <p class="font-semibold text-indigo-600">
        {{ profile.personalizedPath.recommendedPath }}
      </p>

      <p class="mt-3 text-sm">
        Next: {{ profile.personalizedPath.nextLesson.title }}
      </p>
    </BaseCard>
</template>
<script setup>
import { ref, computed, onMounted } from 'vue'
import { useProfileStore } from '../../stores/useProfileStore.js'
import BaseCard from './BaseCard.vue'

</script>
<style>
    
</style>