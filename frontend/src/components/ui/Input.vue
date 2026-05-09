<!-- src/components/ui/Input.vue -->
<template>
    <div class="space-y-1.5">
        <label v-if="label" class="block text-sm font-medium text-neutral-700">
            {{ label }}
        </label>
        <input :type="type" :value="modelValue" @input="emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder" :required="required"
            class="w-full px-5 py-3.5 border border-neutral-300 rounded-2xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all text-base placeholder:text-neutral-400"
            :class="{ 'border-red-300 focus:border-red-500': error }" />
        <p v-if="error" class="text-sm text-red-600">{{ error }}</p>
        <p v-else-if="help" class="text-xs text-neutral-500">{{ help }}</p>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

defineProps({
    modelValue: { type: [String, Number], default: '' },
    label: String,
    placeholder: String,
    type: { type: String, default: 'text' },
    required: Boolean,
    error: String,
    help: String
})

const emit = defineEmits(['update:modelValue'])
</script>