<!-- src/components/ui/Alert.vue -->
<template>
    <div :class="`p-4 rounded-2xl border ${typeClasses}`">
        <slot />
    </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    type: { type: String, default: 'info' }
})

const typeClasses = {
    success: 'bg-green-50 border-green-200 text-green-800',
    error: 'bg-red-50 border-red-200 text-red-800',
    warning: 'bg-amber-50 border-amber-200 text-amber-800',
    info: 'bg-blue-50 border-blue-200 text-blue-800'
}[props.type]
</script>