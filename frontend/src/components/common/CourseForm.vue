<!-- src/components/common/CourseForm.vue -->
<script setup>
import { reactive } from 'vue'

const props = defineProps({
    initialData: Object
})

const emit = defineEmits(['submit'])

const form = reactive({
    title: props.initialData?.title || '',
    description: props.initialData?.description || '',
    price: props.initialData?.price || 0,
    thumbnail: props.initialData?.thumbnail || ''
})

const handleSubmit = () => {
    emit('submit', form)
}
</script>

<template>
    <div class="border bg-amber-100">
        <form @submit.prevent="handleSubmit" class="space-y-4">
    
            <input v-model="form.title" placeholder="Tên khóa học" class="input" />
    
            <textarea v-model="form.description" placeholder="Mô tả" class="input"></textarea>
    
            <input v-model="form.price" type="number" class="input" />
    
            <input v-model="form.thumbnail" placeholder="Thumbnail URL" class="input" />
    
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">
                Lưu
            </button>
    
        </form>
    </div>
</template>
<style scoped>

</style>