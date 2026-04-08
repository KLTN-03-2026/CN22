<template>
    <BaseCard>
        <div class="grid gap-4">
            <input v-model="profile.personalInfo.name" 
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" />

            <input v-model="profile.personalInfo.email" 
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" />

            <button @click="$emit('update', 'personal')" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-sm hover:shadow-md hover:bg-indigo-700 transition-all duration-200 active:scale-[0.98] transition">
                Lưu thay đổi
                </button>
            </div>
    </BaseCard>
</template>

<script setup>
import { reactive, watch } from 'vue'
import BaseCard from './BaseCard.vue'

const props = defineProps(['profile'])
const emit = defineEmits(['update'])

const localData = reactive({
    name: '',
    email: ''
})

watch(() => props.profile, (val) => {
    if (val) {
        localData.name = val.personalInfo.name
        localData.email = val.personalInfo.email
    }
}, { immediate: true })

function handleSave() {
    emit('update', {
        type: 'personal',
        payload: localData
    })
}
</script>