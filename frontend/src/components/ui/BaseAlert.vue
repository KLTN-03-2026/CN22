<template>
  <div :class="alertClasses" role="alert">
    <div class="flex">
      <div class="flex-shrink-0">
        <!-- Icons can be added here based on variant -->
        <svg v-if="variant === 'success'" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <svg v-else-if="variant === 'error'" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
      </div>
      <div class="ml-3">
        <p class="text-sm font-medium">
          <slot />
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  variant?: 'success' | 'error' | 'warning' | 'info';
}

const props = withDefaults(defineProps<Props>(), {
  variant: 'info',
});

const alertClasses = computed(() => {
  const base = 'rounded-md p-4';
  const variants = {
    success: 'bg-green-50 text-green-800',
    error: 'bg-red-50 text-red-800',
    warning: 'bg-yellow-50 text-yellow-800',
    info: 'bg-blue-50 text-blue-800',
  };
  return [base, variants[props.variant]];
});
</script>