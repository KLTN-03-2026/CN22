<template>
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center mb-4">
                <button @click="$router.go(-1)"
                    class="mr-4 p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ isEdit ? 'Chỉnh sửa khóa học' : 'Tạo khóa học mới' }}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ isEdit ? 'Cập nhật thông tin khóa học' : 'Điền thông tin để tạo khóa học mới' }}
                    </p>
                </div>
            </div>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Basic Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Thông tin cơ bản</h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tiêu đề khóa học <span class="text-red-500">*</span>
                        </label>
                        <input v-model="form.title" type="text" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nhập tiêu đề khóa học">
                        <p v-if="errors.title" class="mt-1 text-sm text-red-600">{{ errors.title }}</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Mô tả khóa học <span class="text-red-500">*</span>
                        </label>
                        <textarea v-model="form.description" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Mô tả chi tiết về khóa học"></textarea>
                        <p v-if="errors.description" class="mt-1 text-sm text-red-600">{{ errors.description }}</p>
                    </div>

                    <!-- Thumbnail Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ảnh đại diện
                        </label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img v-if="form.thumbnail" :src="form.thumbnail" alt="Course thumbnail"
                                    class="h-20 w-20 object-cover rounded-lg">
                                <div v-else class="h-20 w-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <button type="button" @click="triggerFileUpload"
                                    class="px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Chọn ảnh
                                </button>
                                <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF tối đa 2MB</p>
                            </div>
                            <input ref="fileInput" type="file" accept="image/*" class="hidden"
                                @change="handleFileUpload">
                        </div>
                    </div>

                    <!-- Instructor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Giảng viên <span class="text-red-500">*</span>
                        </label>
                        <select v-model="form.instructorId" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Chọn giảng viên</option>
                            <option v-for="instructor in instructors" :key="instructor.id" :value="instructor.id">
                                {{ instructor.name }}
                            </option>
                        </select>
                        <p v-if="errors.instructorId" class="mt-1 text-sm text-red-600">{{ errors.instructorId }}</p>
                    </div>

                    <!-- Category & Difficulty -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Danh mục <span class="text-red-500">*</span>
                            </label>
                            <select v-model="form.categoryId" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Chọn danh mục</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <p v-if="errors.categoryId" class="mt-1 text-sm text-red-600">{{ errors.categoryId }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Độ khó <span class="text-red-500">*</span>
                            </label>
                            <select v-model="form.difficulty" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Chọn độ khó</option>
                                <option value="beginner">Cơ bản</option>
                                <option value="intermediate">Trung bình</option>
                                <option value="advanced">Nâng cao</option>
                            </select>
                            <p v-if="errors.difficulty" class="mt-1 text-sm text-red-600">{{ errors.difficulty }}</p>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Giá khóa học</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input v-model="form.isFree" type="radio" :value="true" id="free"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="free" class="ml-2 block text-sm font-medium text-gray-700">
                                    Miễn phí
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input v-model="form.isFree" type="radio" :value="false" id="paid"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="paid" class="ml-2 block text-sm font-medium text-gray-700">
                                    Trả phí
                                </label>
                            </div>
                            <div v-if="!form.isFree" class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Giá khóa học (VNĐ) <span class="text-red-500">*</span>
                                </label>
                                <input v-model="form.price" type="number" min="0" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Nhập giá khóa học">
                                <p v-if="errors.price" class="mt-1 text-sm text-red-600">{{ errors.price }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="border-t pt-6">
                        <div class="flex items-center">
                            <input v-model="form.status" type="checkbox" id="status" true-value="1" false-value="0"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="status" class="ml-2 block text-sm font-medium text-gray-700">
                                Đăng bài ngay
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Bỏ chọn nếu muốn lưu nháp</p>
                    </div>
                </div>
            </div>

            <!-- Curriculum Management -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Chương trình học</h2>
                        <button type="button" @click="addChapter"
                            class="px-3 py-1 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Thêm chương
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div v-if="form.chapters.length === 0" class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Chưa có chương học nào</h3>
                        <p class="mt-1 text-sm text-gray-500">Bắt đầu bằng cách thêm chương học đầu tiên</p>
                    </div>

                    <div v-else class="space-y-4">
                        <div v-for="(chapter, chapterIndex) in form.chapters" :key="chapter.id"
                            class="border border-gray-200 rounded-lg">
                            <div class="p-4 bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <button type="button" @click="toggleChapter(chapterIndex)"
                                            class="p-1 rounded hover:bg-gray-200">
                                            <svg class="w-5 h-5 text-gray-500" :class="{ 'rotate-90': chapter.isOpen }"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                        <input v-model="chapter.title" type="text"
                                            class="font-medium text-gray-900 bg-transparent border-b border-transparent hover:border-gray-300 focus:border-blue-500 focus:outline-none"
                                            placeholder="Tiêu đề chương">
                                        <span class="text-sm text-gray-500">({{ chapter.lessons.length }} bài
                                            học)</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button type="button" @click="moveChapterUp(chapterIndex)"
                                            :disabled="chapterIndex === 0"
                                            class="p-1 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7" />
                                            </svg>
                                        </button>
                                        <button type="button" @click="moveChapterDown(chapterIndex)"
                                            :disabled="chapterIndex === form.chapters.length - 1"
                                            class="p-1 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <button type="button" @click="removeChapter(chapterIndex)"
                                            class="p-1 rounded hover:bg-red-100 text-red-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Lessons -->
                            <div v-show="chapter.isOpen" class="border-t border-gray-200">
                                <div class="p-4 space-y-2">
                                    <div v-for="(lesson, lessonIndex) in chapter.lessons" :key="lesson.id"
                                        class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <input v-model="lesson.title" type="text"
                                                class="flex-1 text-sm bg-transparent border-b border-transparent hover:border-gray-300 focus:border-blue-500 focus:outline-none"
                                                placeholder="Tiêu đề bài học">
                                            <select v-model="lesson.type"
                                                class="text-sm border border-gray-300 rounded px-2 py-1">
                                                <option value="theory">Lý thuyết</option>
                                                <option value="quiz">Quiz</option>
                                                <option value="coding">Lập trình</option>
                                            </select>
                                        </div>
                                        <button type="button" @click="removeLesson(chapterIndex, lessonIndex)"
                                            class="p-1 rounded hover:bg-red-100 text-red-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <button type="button" @click="addLesson(chapterIndex)"
                                        class="w-full p-2 border-2 border-dashed border-gray-300 rounded text-sm text-gray-500 hover:border-gray-400 hover:text-gray-600">
                                        + Thêm bài học
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Cài đặt bổ sung</h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Certificate -->
                    <div class="flex items-center">
                        <input v-model="form.settings.certificate" type="checkbox" id="certificate"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="certificate" class="ml-2 block text-sm font-medium text-gray-700">
                            Cấp chứng chỉ hoàn thành
                        </label>
                    </div>

                    <!-- Prerequisites -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Điều kiện tiên quyết
                        </label>
                        <select v-model="form.settings.prerequisites" multiple
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option v-for="course in availablePrerequisites" :key="course.id" :value="course.id">
                                {{ course.title }}
                            </option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Giữ Ctrl/Cmd để chọn nhiều khóa học</p>
                    </div>

                    <!-- Duration -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Thời lượng ước tính (giờ)
                            </label>
                            <input v-model="form.settings.duration" type="number" min="1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="VD: 40">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ngôn ngữ
                            </label>
                            <select v-model="form.settings.language"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="vi">Tiếng Việt</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <button type="button" @click="$router.go(-1)"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Hủy
                </button>
                <button type="button" @click="saveDraft"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Lưu nháp
                </button>
                <button type="submit" :disabled="submitting"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span v-if="submitting" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Đang lưu...
                    </span>
                    <span v-else>{{ isEdit ? 'Cập nhật' : 'Tạo khóa học' }}</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

// State
const isEdit = computed(() => !!route.params.id)
const submitting = ref(false)
const fileInput = ref(null)

// Form data
const form = reactive({
    title: '',
    description: '',
    thumbnail: '',
    instructorId: '',
    categoryId: '',
    difficulty: '',
    isFree: true,
    price: 0,
    status: 1,
    chapters: [],
    settings: {
        certificate: false,
        prerequisites: [],
        duration: '',
        language: 'vi'
    }
})

// Validation errors
const errors = reactive({})

// Mock data
const instructors = ref([
    { id: 1, name: 'Nguyễn Văn An' },
    { id: 2, name: 'Trần Thị Bình' },
    { id: 3, name: 'Lê Văn Cường' }
])

const categories = ref([
    { id: 1, name: 'Lập trình Web' },
    { id: 2, name: 'Lập trình Mobile' },
    { id: 3, name: 'Lập trình Backend' },
    { id: 4, name: 'AI & Machine Learning' }
])

const availablePrerequisites = ref([
    { id: 1, title: 'HTML & CSS Cơ bản' },
    { id: 2, title: 'JavaScript Cơ bản' },
    { id: 3, title: 'React Cơ bản' }
])

// Methods
const triggerFileUpload = () => {
    fileInput.value.click()
}

const handleFileUpload = (event) => {
    const file = event.target.files[0]
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('Kích thước file không được vượt quá 2MB')
            return
        }
        const reader = new FileReader()
        reader.onload = (e) => {
            form.thumbnail = e.target.result
        }
        reader.readAsDataURL(file)
    }
}

const addChapter = () => {
    const newChapter = {
        id: Date.now(),
        title: '',
        isOpen: true,
        lessons: []
    }
    form.chapters.push(newChapter)
}

const removeChapter = (index) => {
    if (confirm('Bạn có chắc muốn xóa chương này?')) {
        form.chapters.splice(index, 1)
    }
}

const toggleChapter = (index) => {
    form.chapters[index].isOpen = !form.chapters[index].isOpen
}

const moveChapterUp = (index) => {
    if (index > 0) {
        const temp = form.chapters[index]
        form.chapters[index] = form.chapters[index - 1]
        form.chapters[index - 1] = temp
    }
}

const moveChapterDown = (index) => {
    if (index < form.chapters.length - 1) {
        const temp = form.chapters[index]
        form.chapters[index] = form.chapters[index + 1]
        form.chapters[index + 1] = temp
    }
}

const addLesson = (chapterIndex) => {
    const newLesson = {
        id: Date.now(),
        title: '',
        type: 'theory'
    }
    form.chapters[chapterIndex].lessons.push(newLesson)
}

const removeLesson = (chapterIndex, lessonIndex) => {
    form.chapters[chapterIndex].lessons.splice(lessonIndex, 1)
}

const validateForm = () => {
    const newErrors = {}

    if (!form.title.trim()) {
        newErrors.title = 'Tiêu đề không được để trống'
    }

    if (!form.description.trim()) {
        newErrors.description = 'Mô tả không được để trống'
    }

    if (!form.instructorId) {
        newErrors.instructorId = 'Vui lòng chọn giảng viên'
    }

    if (!form.categoryId) {
        newErrors.categoryId = 'Vui lòng chọn danh mục'
    }

    if (!form.difficulty) {
        newErrors.difficulty = 'Vui lòng chọn độ khó'
    }

    if (!form.isFree && (!form.price || form.price <= 0)) {
        newErrors.price = 'Giá khóa học phải lớn hơn 0'
    }

    // Clear old errors and set new ones
    Object.keys(errors).forEach(key => delete errors[key])
    Object.assign(errors, newErrors)

    return Object.keys(newErrors).length === 0
}

const saveDraft = async () => {
    submitting.value = true
    try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000))
        alert('Đã lưu nháp thành công!')
    } catch (error) {
        alert('Có lỗi xảy ra khi lưu nháp')
    } finally {
        submitting.value = false
    }
}

const handleSubmit = async () => {
    if (!validateForm()) return

    submitting.value = true
    try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 2000))

        alert(isEdit.value ? 'Cập nhật khóa học thành công!' : 'Tạo khóa học thành công!')
        router.push('/admin/courses')
    } catch (error) {
        alert('Có lỗi xảy ra. Vui lòng thử lại.')
    } finally {
        submitting.value = false
    }
}

// Load course data if editing
const loadCourseData = async () => {
    if (isEdit.value) {
        // Simulate API call to load course data
        const courseData = {
            id: 1,
            title: 'JavaScript Cơ bản',
            description: 'Khóa học JavaScript từ cơ bản đến nâng cao',
            thumbnail: 'https://picsum.photos/seed/js-course/200/200.jpg',
            instructorId: 1,
            categoryId: 1,
            difficulty: 'beginner',
            isFree: false,
            price: 990000,
            status: 1,
            chapters: [
                {
                    id: 1,
                    title: 'Giới thiệu JavaScript',
                    isOpen: true,
                    lessons: [
                        { id: 1, title: 'JavaScript là gì?', type: 'theory' },
                        { id: 2, title: 'Lịch sửển JavaScript', type: 'theory' }
                    ]
                }
            ],
            settings: {
                certificate: true,
                prerequisites: [],
                duration: 40,
                language: 'vi'
            }
        }

        Object.assign(form, courseData)
    }
}

// Initialize
onMounted(() => {
    loadCourseData()
})
</script>