<script setup lang="ts">
interface Props {
  padding?: 'none' | 'sm' | 'md' | 'lg'
  hoverable?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  padding: 'md',
  hoverable: false
})
</script>

<template>
  <div
    class="bg-white rounded-xl shadow-sm border border-gray-100"
    :class="[
      {
        'p-0': padding === 'none',
        'p-4': padding === 'sm',
        'p-6': padding === 'md',
        'p-8': padding === 'lg',
        'hover:shadow-md hover:border-gray-200 transition-all duration-200 cursor-pointer': hoverable
      }
    ]"
  >
    <slot />
  </div>
</template>
