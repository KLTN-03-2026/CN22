<!-- src/components/ui/Button.vue -->
<template>
    <button :type="type" :disabled="disabled || loading" @click="handleClick"
        class="inline-flex items-center justify-center gap-2 font-medium rounded-2xl transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:cursor-not-allowed text-sm px-6 py-3"
        :class="[
            variantClasses,
            sizeClasses,
            fullWidth ? 'w-full' : ''
        ]">
        <span v-if="loading"
            class="animate-spin w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
        <slot />
    </button>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
    variant: { type: String, default: 'primary' },
    size: { type: String, default: 'md' },
    disabled: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
    fullWidth: { type: Boolean, default: false },
    type: { type: String, default: 'button' }
})

const emit = defineEmits(['click'])

const variantClasses = {
    primary: 'bg-primary-600 hover:bg-primary-700 text-white focus:ring-primary-500',
    secondary: 'bg-neutral-100 hover:bg-neutral-200 text-neutral-800 focus:ring-neutral-400',
    outline: 'border border-neutral-300 hover:bg-neutral-50 text-neutral-700 focus:ring-neutral-400',
    danger: 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500'
}[props.variant]

const sizeClasses = {
    sm: 'px-4 py-2 text-xs',
    md: 'px-6 py-3 text-sm',
    lg: 'px-8 py-4 text-base'
}[props.size]

const handleClick = (e) => {
    if (!props.disabled && !props.loading) emit('click', e)
}
</script>