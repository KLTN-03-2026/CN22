<!-- src/views/admin/CoursesView.vue -->
<!-- <script setup>
import { onMounted } from 'vue'
import { useAdminCourseStore } from '../../stores/adminCourse.js'
import { useRouter } from 'vue-router'

const store = useAdminCourseStore()
const router = useRouter()

onMounted(store.fetchCourses)

const goCreate = () => router.push('/admin/courses/create')
const goEdit = (id) => router.push(`/admin/courses/${id}/edit`)

const remove = async (id) => {
    if (!confirm('Xóa khóa học?')) return
    await store.deleteCourse(id)
    store.fetchCourses()
} 
</script> -->
<script setup>
import { ref, onMounted } from 'vue'
import { useAdminCourseStore } from '../../stores/adminCourse.js'
import { useRouter } from 'vue-router'

const store = useAdminCourseStore()
const router = useRouter()

// Modal states
const showCreateModal = ref(false)
const showEditModal = ref(false)
const showDeleteModal = ref(false)
const newCourse = ref({
    name: '',
    description: '',
    status: 'active'
})
const editingCourse = ref({})
const deletingCourse = ref(null)

onMounted(store.fetchCourses)

// Modal handlers
const openCreateModal = () => {
    newCourse.value = {
        name: '',
        description: '',
        status: 'active'
    }
    showCreateModal.value = true
}

const closeCreateModal = () => {
    showCreateModal.value = false
}

const openEditModal = (course) => {
    editingCourse.value = { ...course }
    showEditModal.value = true
}

const closeEditModal = () => {
    showEditModal.value = false
}

const confirmDelete = (course) => {
    deletingCourse.value = course
    showDeleteModal.value = true
}

const closeDeleteModal = () => {
    showDeleteModal.value = false
}

// CRUD operations
const createCourse = async () => {
    await store.createCourse(newCourse.value)
    closeCreateModal()
    store.fetchCourses()
}

const updateCourse = async () => {
    await store.updateCourse(editingCourse.value.id, editingCourse.value)
    closeEditModal()
    store.fetchCourses()
}

const deleteCourse = async () => {
    if (deletingCourse.value) {
        await store.deleteCourse(deletingCourse.value.id)
        closeDeleteModal()
        store.fetchCourses()
    }
}
</script>
<template>
    <div class="p-4">
        <div class="bg-white rounded-xl p-4 mb-6 shadow-sm flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400"></i>
                    <input type="text" placeholder="Tìm kiếm khóa học..."
                        class="w-full pl-10 pr-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" />
                </div>
            </div>
            <div class="flex gap-2">
                <select
                    class="px-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option>Tất cả trạng thái</option>
                    <option>Đang hoạt động</option>
                    <option>Ngừng hoạt động</option>
                </select>
                <button class="px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition-colors">
                    <i class="fas fa-filter mr-2"></i>Lọc
                </button>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="text-sm text-indigo-500">
                Hiển thị {{ store.courses.length }} khóa học
            </div>
            <button
                class="btn btn-primary px-4 py-2 bg-primary text-white rounded-xl hover:bg-primary-700 transition-colors flex items-center gap-2"
                aria-haspopup="dialog" aria-expanded="false" aria-controls="basic-modal" data-overlay="#basic-modal">
                <i class="fas fa-plus"></i>
                Thêm mới
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200">
                    <thead class="bg-neutral-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Tên khóa học
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Mô tả
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Trạng thái
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Ngày tạo
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Hành động
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-neutral-200">
                        <tr v-for="course in store.courses" :key="course.id"
                            class="hover:bg-neutral-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-neutral-900">{{ course.name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-neutral-500">{{ course.description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full" :class="{
                                    'bg-green-100 text-green-800': course.status === 'active',
                                    'bg-red-100 text-red-800': course.status === 'inactive',
                                    'bg-yellow-100 text-yellow-800': course.status === 'pending'
                                }">
                                    {{ course.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">
                                {{ course.createdAt }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="openEditModal(course)"
                                    class="text-primary-600 hover:text-primary-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button @click="confirmDelete(course)" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Modal -->
        <button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false"
            aria-controls="basic-modal" data-overlay="#basic-modal"> Open modal </button>

        <div id="basic-modal" class="overlay modal overlay-open:opacity-100 hidden overlay-open:duration-300"
            role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Dialog Title</h3>
                        <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3"
                            aria-label="Close" data-overlay="#basic-modal">
                            <span class="icon-[tabler--x] size-4"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        This is some placeholder content to show the scrolling behavior for modals. Instead of repeating
                        the text in the
                        modal, we use an inline style to set a minimum height, thereby extending the length of the
                        overall modal and
                        demonstrating the overflow scrolling. When content becomes longer than the height of the
                        viewport, scrolling
                        will move the modal as needed.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-soft btn-secondary"
                            data-overlay="#basic-modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showCreateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4">Thêm khóa học mới</h3>
                <form @submit.prevent="createCourse">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Tên khóa học</label>
                        <input type="text" v-model="newCourse.name"
                            class="w-full px-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            required />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Mô tả</label>
                        <textarea v-model="newCourse.description" rows="3"
                            class="w-full px-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Trạng thái</label>
                        <select v-model="newCourse.status"
                            class="w-full px-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="active">Đang hoạt động</option>
                            <option value="inactive">Ngừng hoạt động</option>
                            <option value="pending">Chờ duyệt</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeCreateModal"
                            class="px-4 py-2 border border-neutral-300 rounded-xl hover:bg-neutral-100 transition-colors">
                            Hủy
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition-colors">
                            Thêm
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4">Chỉnh sửa khóa học</h3>
                <form @submit.prevent="updateCourse">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Tên khóa học</label>
                        <input type="text" v-model="editingCourse.name"
                            class="w-full px-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            required />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Mô tả</label>
                        <textarea v-model="editingCourse.description" rows="3"
                            class="w-full px-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Trạng thái</label>
                        <select v-model="editingCourse.status"
                            class="w-full px-4 py-2 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="active">Đang hoạt động</option>
                            <option value="inactive">Ngừng hoạt động</option>
                            <option value="pending">Chờ duyệt</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeEditModal"
                            class="px-4 py-2 border border-neutral-300 rounded-xl hover:bg-neutral-100 transition-colors">
                            Hủy
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition-colors">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4">Xóa khóa học</h3>
                <p class="text-neutral-600 mb-6">
                    Bạn có chắc chắn muốn xóa khóa học "<strong>{{ deletingCourse?.name }}</strong>"? Hành động này
                    không thể hoàn tác.
                </p>
                <div class="flex justify-end gap-2">
                    <button @click="closeDeleteModal"
                        class="px-4 py-2 border border-neutral-300 rounded-xl hover:bg-neutral-100 transition-colors">
                        Hủy
                    </button>
                    <button @click="deleteCourse"
                        class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                        Xóa
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
