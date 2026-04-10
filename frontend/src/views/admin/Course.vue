<template>
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Quản lý khóa học</h1>
                    <p class="mt-1 text-sm text-gray-500">Quản lý tất cả khóa học trên nền tảng</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <router-link to="/admin/courses/new"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Thêm khóa học mới
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="p-6 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                        <div class="relative">
                            <input v-model="searchQuery" type="text"
                                placeholder="Tìm kiếm theo tên khóa học hoặc giảng viên..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @input="debouncedSearch">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <select v-model="filters.status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @change="applyFilters">
                            <option value="">Tất cả</option>
                            <option value="1">Đang hoạt động</option>
                            <option value="0">Không hoạt động</option>
                            <option value="2">Lưu trữ</option>
                        </select>
                    </div>

                    <!-- Price Range Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Khoảng giá</label>
                        <select v-model="filters.priceRange"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @change="applyFilters">
                            <option value="">Tất cả</option>
                            <option value="free">Miễn phí</option>
                            <option value="0-500000">0 - 500.000 VNĐ</option>
                            <option value="500000-1000000">500.000 - 1.000.000 VNĐ</option>
                            <option value="1000000+">Trên 1.000.000 VNĐ</option>
                        </select>
                    </div>
                </div>

                <!-- Date Range Filter -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Từ ngày</label>
                        <input v-model="filters.dateFrom" type="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @change="applyFilters">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Đến ngày</label>
                        <input v-model="filters.dateTo" type="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @change="applyFilters">
                    </div>
                    <div class="flex items-end">
                        <button @click="resetFilters"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Đặt lại bộ lọc
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bulk Actions -->
            <div v-if="selectedCourses.length > 0" class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">
                        Đã chọn {{ selectedCourses.length }} khóa học
                    </span>
                    <div class="flex space-x-2">
                        <button @click="bulkAction('activate')"
                            class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded hover:bg-green-200">
                            Kích hoạt
                        </button>
                        <button @click="bulkAction('deactivate')"
                            class="px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded hover:bg-yellow-200">
                            Vô hiệu hóa
                        </button>
                        <button @click="bulkAction('delete')"
                            class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded hover:bg-red-200">
                            Xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" :checked="allSelected" @change="toggleSelectAll"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Khóa học</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Giảng viên</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Học viên</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Doanh thu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="course in paginatedCourses" :key="course.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" :checked="selectedCourses.includes(course.id)"
                                    @change="toggleCourseSelection(course.id)"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                #{{ course.id }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-lg object-cover" :src="course.thumbnail"
                                        :alt="course.title">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ course.title }}</div>
                                        <div class="text-sm text-gray-500">{{ course.chapters }} chương • {{
                                            course.lessons }} bài học</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" :src="course.instructorAvatar"
                                        :alt="course.instructor">
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">{{ course.instructor }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ course.students.toLocaleString() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="course.isFree" class="text-sm font-medium text-green-600">Miễn phí</span>
                                <span v-else class="text-sm font-medium text-gray-900">{{ formatCurrency(course.price)
                                    }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusBadgeClass(course.status)"
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {{ getStatusText(course.status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ formatCurrency(course.revenue) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <router-link :to="`/admin/courses/${course.id}/edit`"
                                        class="text-blue-600 hover:text-blue-900">
                                        Sửa
                                    </router-link>
                                    <button @click="viewCourse(course.id)" class="text-gray-600 hover:text-gray-900">
                                        Xem
                                    </button>
                                    <button @click="deleteCourse(course.id)" class="text-red-600 hover:text-red-900">
                                        Xóa
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div v-if="filteredCourses.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Không tìm thấy khóa học</h3>
                <p class="mt-1 text-sm text-gray-500">Thử điều chỉnh bộ lọc hoặc tìm kiếm với từ khóa khác.</p>
            </div>
        </div>

        <!-- Pagination -->
        <div v-if="filteredCourses.length > 0"
            class="bg-white shadow rounded-lg mt-6 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    Trước
                </button>
                <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    Sau
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Hiển thị
                        <span class="font-medium">{{ startIndex + 1 }}</span>
                        đến
                        <span class="font-medium">{{ endIndex }}</span>
                        của
                        <span class="font-medium">{{ filteredCourses.length }}</span>
                        kết quả
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button v-for="page in visiblePages" :key="page" @click="goToPage(page)" :class="[
                            'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                            page === currentPage
                                ? 'z-10 bg-blue-50 border-blue-500 text-blue-600'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                        ]">
                            {{ page }}
                        </button>

                        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Per Page Selector -->
        <div class="mt-4 flex items-center justify-end">
            <label class="text-sm text-gray-700 mr-2">Hiển thị:</label>
            <select v-model="itemsPerPage" @change="currentPage = 1"
                class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span class="ml-2 text-sm text-gray-700">kết quả mỗi trang</span>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// State
const searchQuery = ref('')
const selectedCourses = ref([])
const currentPage = ref(1)
const itemsPerPage = ref(25)
const loading = ref(false)

// Filters
const filters = reactive({
    status: '',
    priceRange: '',
    dateFrom: '',
    dateTo: ''
})

// Mock data
const courses = ref([
    {
        id: 1,
        title: 'JavaScript Cơ bản',
        thumbnail: 'https://picsum.photos/seed/js-basic/200/200.jpg',
        instructor: 'Nguyễn Văn An',
        instructorAvatar: 'https://picsum.photos/seed/instructor1/100/100.jpg',
        chapters: 12,
        lessons: 48,
        students: 1250,
        isFree: false,
        price: 990000,
        status: 1,
        revenue: 123750000,
        createdAt: new Date('2023-01-15')
    },
    {
        id: 2,
        title: 'React Nâng cao',
        thumbnail: 'https://picsum.photos/seed/react-advanced/200/200.jpg',
        instructor: 'Trần Thị Bình',
        instructorAvatar: 'https://picsum.photos/seed/instructor2/100/100.jpg',
        chapters: 8,
        lessons: 32,
        students: 890,
        isFree: false,
        price: 1490000,
        status: 1,
        revenue: 132610000,
        createdAt: new Date('2023-02-20')
    },
    {
        id: 3,
        title: 'Node.js Backend',
        thumbnail: 'https://picsum.photos/seed/nodejs/200/200.jpg',
        instructor: 'Lê Văn Cường',
        instructorAvatar: 'https://picsum.photos/seed/instructor3/100/100.jpg',
        chapters: 10,
        lessons: 40,
        students: 650,
        isFree: false,
        price: 1290000,
        revenue: 83850000,
        createdAt: new Date('2023-03-10')
    },
    {
        id: 4,
        title: 'HTML & CSS',
        thumbnail: 'https://picsum.photos/seed/html-css/200/200.jpg',
        instructor: 'Phạm Thị Dung',
        instructorAvatar: 'https://picsum.photos/seed/instructor4/100/100.jpg',
        chapters: 6,
        lessons: 24,
        students: 2100,
        isFree: true,
        price: 0,
        status: 1,
        revenue: 0,
        createdAt: new Date('2023-01-05')
    },
    {
        id: 5,
        title: 'Vue.js 3 Complete',
        thumbnail: 'https://picsum.photos/seed/vuejs/200/200.jpg',
        instructor: 'Hoàng Văn Em',
        instructorAvatar: 'https://picsum.photos/seed/instructor5/100/100.jpg',
        chapters: 15,
        lessons: 60,
        students: 450,
        isFree: false,
        price: 1890000,
        status: 0,
        revenue: 0,
        createdAt: new Date('2023-04-01')
    }
])

// Computed properties
const filteredCourses = computed(() => {
    let filtered = courses.value

    // Search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase()
        filtered = filtered.filter(course =>
            course.title.toLowerCase().includes(query) ||
            course.instructor.toLowerCase().includes(query)
        )
    }

    // Status filter
    if (filters.status !== '') {
        filtered = filtered.filter(course => course.status === parseInt(filters.status))
    }

    // Price range filter
    if (filters.priceRange) {
        if (filters.priceRange === 'free') {
            filtered = filtered.filter(course => course.isFree)
        } else if (filters.priceRange === '0-500000') {
            filtered = filtered.filter(course => !course.isFree && course.price <= 500000)
        } else if (filters.priceRange === '500000-1000000') {
            filtered = filtered.filter(course => !course.isFree && course.price > 500000 && course.price <= 1000000)
        } else if (filters.priceRange === '1000000+') {
            filtered = filtered.filter(course => !course.isFree && course.price > 1000000)
        }
    }

    // Date range filter
    if (filters.dateFrom) {
        const fromDate = new Date(filters.dateFrom)
        filtered = filtered.filter(course => course.createdAt >= fromDate)
    }
    if (filters.dateTo) {
        const toDate = new Date(filters.dateTo)
        toDate.setHours(23, 59, 59, 999)
        filtered = filtered.filter(course => course.createdAt <= toDate)
    }

    return filtered
})

const totalPages = computed(() => Math.ceil(filteredCourses.value.length / itemsPerPage.value))

const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage.value)

const endIndex = computed(() => Math.min(startIndex.value + itemsPerPage.value, filteredCourses.value.length))

const paginatedCourses = computed(() => {
    return filteredCourses.value.slice(startIndex.value, endIndex.value)
})

const allSelected = computed(() =>
    selectedCourses.value.length === paginatedCourses.value.length && paginatedCourses.value.length > 0
)

const visiblePages = computed(() => {
    const pages = []
    const maxVisible = 5
    const half = Math.floor(maxVisible / 2)

    let start = Math.max(1, currentPage.value - half)
    let end = Math.min(totalPages.value, start + maxVisible - 1)

    if (end - start < maxVisible - 1) {
        start = Math.max(1, end - maxVisible + 1)
    }

    for (let i = start; i <= end; i++) {
        pages.push(i)
    }

    return pages
})

// Methods
const formatCurrency = (amount) => {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        minimumFractionDigits: 0
    }).format(amount)
}

const getStatusBadgeClass = (status) => {
    switch (status) {
        case 1:
            return 'bg-green-100 text-green-800'
        case 0:
            return 'bg-yellow-100 text-yellow-800'
        case 2:
            return 'bg-gray-100 text-gray-800'
        default:
            return 'bg-gray-100 text-gray-800'
    }
}

const getStatusText = (status) => {
    switch (status) {
        case 1:
            return 'Đang hoạt động'
        case 0:
            return 'Không hoạt động'
        case 2:
            return 'Lưu trữ'
        default:
            return 'Không xác định'
    }
}

const toggleSelectAll = () => {
    if (allSelected.value) {
        selectedCourses.value = []
    } else {
        selectedCourses.value = paginatedCourses.value.map(course => course.id)
    }
}

const toggleCourseSelection = (courseId) => {
    const index = selectedCourses.value.indexOf(courseId)
    if (index > -1) {
        selectedCourses.value.splice(index, 1)
    } else {
        selectedCourses.value.push(courseId)
    }
}

const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page
    }
}

const applyFilters = () => {
    currentPage.value = 1
}

const resetFilters = () => {
    filters.status = ''
    filters.priceRange = ''
    filters.dateFrom = ''
    filters.dateTo = ''
    searchQuery.value = ''
    currentPage.value = 1
}

const debouncedSearch = (() => {
    let timeout
    return () => {
        clearTimeout(timeout)
        timeout = setTimeout(() => {
            currentPage.value = 1
        }, 300)
    }
})()

const bulkAction = (action) => {
    if (selectedCourses.value.length === 0) return

    const confirmMessage = `Bạn có chắc muốn ${action === 'activate' ? 'kích hoạt' : action === 'deactivate' ? 'vô hiệu hóa' : 'xóa'} ${selectedCourses.value.length} khóa học đã chọn?`

    if (confirm(confirmMessage)) {
        // In a real app, this would be an API call
        console.log(`Bulk ${action} courses:`, selectedCourses.value)

        // Update local data for demo
        selectedCourses.value.forEach(courseId => {
            const course = courses.value.find(c => c.id === courseId)
            if (course) {
                if (action === 'activate') course.status = 1
                else if (action === 'deactivate') course.status = 0
                else if (action === 'delete') {
                    const index = courses.value.findIndex(c => c.id === courseId)
                    if (index > -1) courses.value.splice(index, 1)
                }
            }
        })

        selectedCourses.value = []
    }
}

const viewCourse = (courseId) => {
    router.push(`/admin/courses/${courseId}`)
}

const deleteCourse = (courseId) => {
    if (confirm('Bạn có chắc muốn xóa khóa học này?')) {
        // In a real app, this would be an API call
        const index = courses.value.findIndex(c => c.id === courseId)
        if (index > -1) {
            courses.value.splice(index, 1)
        }
    }
}

// Watch for changes
watch(itemsPerPage, () => {
    currentPage.value = 1
})

// Initialize
onMounted(() => {
    // In a real app, this would fetch data from API
})
</script>