<!-- src/views/admin/CourseEditView.vue -->
<script setup>
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import CourseForm from '../../components/common/CourseForm.vue'
import apiClient from '../../api/axios.js'

const route = useRoute()
const router = useRouter()

const course = ref(null)

onMounted(async () => {
    const res = await apiClient.get(`/admin/courses/${route.params.id}`)
    course.value = res.data
})

const submit = async (data) => {
    await apiClient.put(`/admin/courses/${route.params.id}`, data)
    router.push('/admin/courses')
}
</script>

<template>
    <div class="p-6 max-w-xl">

        <h1 class="text-xl font-bold mb-4">Sửa khóa học</h1>

        <CourseForm v-if="course" :initialData="course" @submit="submit" />

    </div>
</template>