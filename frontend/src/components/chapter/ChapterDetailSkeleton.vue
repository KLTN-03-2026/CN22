<template>
  <div class="max-w-4xl mx-auto">
    <!-- Breadcrumb Skeleton -->
    <div class="flex items-center gap-2 mb-6">
      <BaseSkeleton width="80px" height="1rem" />
      <BaseSkeleton width="16px" height="1rem" />
      <BaseSkeleton width="120px" height="1rem" />
      <BaseSkeleton width="16px" height="1rem" />
      <BaseSkeleton width="100px" height="1rem" />
    </div>

    <!-- Header Skeleton -->
    <BaseCard class="mb-8">
      <div class="flex items-start gap-4">
        <BaseSkeleton width="4rem" height="4rem" rounded="lg" />
        <div class="flex-1">
          <BaseSkeleton height="1.75rem" width="60%" class="mb-3" />
          <BaseSkeleton height="1rem" class="mb-2" />
          <BaseSkeleton height="1rem" width="80%" class="mb-4" />
          <BaseSkeleton height="0.5rem" width="40%" />
        </div>
      </div>
    </BaseCard>

    <!-- Lessons Section Skeleton -->
    <BaseSkeleton height="1.5rem" width="150px" class="mb-6" />
    
    <div class="space-y-3">
      <BaseCard v-for="i in 5" :key="i">
        <div class="flex items-start gap-4">
          <BaseSkeleton width="2.5rem" height="2.5rem" rounded="full" />
          <div class="flex-1">
            <BaseSkeleton height="1.25rem" width="50%" class="mb-2" />
            <BaseSkeleton height="0.75rem" width="30%" />
          </div>
        </div>
      </BaseCard>
    </div>
  </div>
</template>
<script setup>
import BaseSkeleton  from '../ui/BaseSkeleton.vue'
import BaseCard from '../ui/BaseCard.vue'
</script>