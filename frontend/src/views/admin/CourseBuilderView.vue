<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useAdminCourseBuilderStore } from '../../stores/adminCourseBuilder.js'

const route = useRoute()
const store = useAdminCourseBuilderStore()

const courseId = route.params.id

const form = ref({
    title: '',
    order: 1,
    is_free: 1,
    price: 0
})

const editingId = ref(null)

onMounted(() => {
    store.fetchChapters(courseId)
})

// ===== CREATE =====
const handleCreate = async () => {
    await store.createChapter(courseId, form.value)

    resetForm()
    store.fetchChapters(courseId)
}

// ===== EDIT =====
const startEdit = (c) => {
    editingId.value = c.id
    form.value = { ...c }
}

const handleUpdate = async () => {
    await store.updateChapter(editingId.value, form.value)

    editingId.value = null
    resetForm()
    store.fetchChapters(courseId)
}

// ===== DELETE =====
const handleDelete = async (id) => {
    if (!confirm('Xóa chapter?')) return
    await store.deleteChapter(id)
    store.fetchChapters(courseId)
}

const resetForm = () => {
    form.value = {
        title: '',
        order: 1,
        is_free: 1,
        price: 0
    }
}
</script>

<template>
    <div class="p-6">

        <!-- HEADER -->
        <h1 class="text-xl font-bold mb-6">Quản lý Chapters</h1>

        <!-- FORM -->
        <div class="bg-white border rounded-lg p-4 mb-6 space-y-3">

            <input v-model="form.title" placeholder="Tên chapter" class="input" />

            <div class="grid grid-cols-3 gap-3">
                <input v-model="form.order" type="number" class="input" placeholder="Order" />

                <select v-model="form.is_free" class="input">
                    <option :value="1">Free</option>
                    <option :value="0">Paid</option>
                </select>

                <input v-model="form.price" type="number" class="input" placeholder="Price" />
            </div>

            <button v-if="editingId" @click="handleUpdate" class="btn-primary">
                Cập nhật
            </button>

            <button v-else @click="handleCreate" class="btn-primary">
                Tạo chapter
            </button>

        </div>

        <!-- TABLE -->
        <table class="w-full text-sm border">

            <thead class="bg-gray-50">
                <tr>
                    <th class="p-2 text-left">Title</th>
                    <th>Order</th>
                    <th>Free</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                <tr v-for="c in store.chapters" :key="c.id" class="border-t">
                    <td class="p-2">{{ c.title }}</td>
                    <td>{{ c.order }}</td>
                    <td>{{ c.is_free ? 'Yes' : 'No' }}</td>
                    <td>{{ c.price }}</td>
                    <td>
                        <span :class="c.status ? 'text-green-600' : 'text-gray-400'">
                            {{ c.status ? 'Active' : 'Hidden' }}
                        </span>
                    </td>

                    <td class="space-x-2">
                        <button @click="startEdit(c)">Sửa</button>
                        <button @click="handleDelete(c.id)" class="text-red-500">
                            Xóa
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</template>