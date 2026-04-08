<template>
  <span :class="badgeClasses">
    <slot />
  </span>
</template>

<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  variant?: 'default' | 'success' | 'warning' | 'danger' | 'info';
}

const props = withDefaults(defineProps<Props>(), {
  variant: 'default',
});

const badgeClasses = computed(() => {
  const base = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium';
  const variants = {
    default: 'bg-gray-100 text-gray-800',
    success: 'bg-green-100 text-green-800',
    warning: 'bg-yellow-100 text-yellow-800',
    danger: 'bg-red-100 text-red-800',
    info: 'bg-blue-100 text-blue-800',
  };
  return [base, variants[props.variant]];
});
</script>