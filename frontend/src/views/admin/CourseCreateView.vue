<!-- src/views/admin/CourseCreateView.vue -->
<script setup>
import CourseForm from '../../components/common/CourseForm.vue'
import { useAdminCourseStore } from '../../stores/adminCourse.js'
import { useRouter } from 'vue-router'

const store = useAdminCourseStore()
const router = useRouter()

const submit = async (data) => {
    await store.createCourse(data)
    router.push('/admin/courses')
}
</script>

<template>
    <div class="p-6 max-w-xl">
        <h1 class="text-xl font-bold mb-4">Tạo khóa học</h1>
        <CourseForm @submit="submit" />
    </div>
</template>