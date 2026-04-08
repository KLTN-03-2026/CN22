<template>
  <div
    :class="skeletonClasses"
    :style="{ width: width, height: height }"
  ></div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  width?: string;
  height?: string;
  rounded?: 'none' | 'sm' | 'md' | 'lg' | 'full' | 'xl';
}

const props = withDefaults(defineProps<Props>(), {
  width: '100%',
  height: '1rem',
  rounded: 'md',
});

const skeletonClasses = computed(() => {
  const base = 'animate-pulse bg-gray-300';
  const roundeds = {
    none: '',
    sm: 'rounded-sm',
    md: 'rounded-md',
    lg: 'rounded-lg',
    xl: 'rounded-xl',
    full: 'rounded-full',
  };
  return [base, roundeds[props.rounded]];
});
</script>