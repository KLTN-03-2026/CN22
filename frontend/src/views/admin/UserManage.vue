<template>
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Quản lý người dùng</h1>
                    <p class="mt-1 text-sm text-gray-500">Quản lý tất cả người dùng trên nền tảng</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <button @click="userStore.openAddModal()"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3" />
                        </svg>
                        Thêm người dùng
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Tổng người dùng</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ stats.totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hoạt động</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ stats.activeUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Mới tháng này</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ stats.newUsersThisMonth }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Premium</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ stats.premiumUsers }}</p>
                    </div>
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
                            <input v-model="searchQuery" type="text" placeholder="Tìm kiếm theo tên, email..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @input="debouncedSearch">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Role Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Vai trò</label>
                        <select v-model="filters.role"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @change="applyFilters">
                            <option value="">Tất cả</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <select v-model="filters.status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @change="applyFilters">
                            <option value="">Tất cả</option>
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
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
            <div v-if="selectedUsers.length > 0" class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">
                        Đã chọn {{ selectedUsers.length }} người dùng
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Loading State -->
            <div v-if="loading" class="p-8 text-center">
                <div class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018 0v.01M12 12a8 8 0 018 0v-.01">
                        </path>
                    </svg>
                </div>
                <span class="ml-2 text-gray-600">Đang tải...</span>
            </div>
            <!-- Table Content -->
            <div v-else class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" :checked="allSelected" @change="toggleSelectAll"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người
                                dùng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vai
                                trò</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng
                                thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày
                                tham gia</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hoạt
                                động cuối</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao
                                tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="user in paginatedUsers" :key="user.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" :checked="selectedUsers.includes(user.id)"
                                    @change="toggleUserSelection(user.id)"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                #{{ user.id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-full"
                                        :src="user.avatar || `https://ui-avatars.com/api/?name=${user.name}&background=random`"
                                        :alt="user.name">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                                        <div class="text-sm text-gray-500">{{ user.phone || 'Chưa cập nhật' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ user.email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getRoleBadgeClass(user.role)"
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {{ getRoleText(user.role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusBadgeClass(user.is_active)"
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {{ user.is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ formatDate(user.created_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ formatLastActive(user.last_active_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button @click="viewUser(user.id)" class="text-blue-600 hover:text-blue-900">
                                        Xem
                                    </button>
                                    <button @click="userStore.openEditModal(user)" class="text-gray-600 hover:text-gray-900">
                                        Sửa
                                    </button>
                                    <button @click="deleteUser(user.id)" class="text-red-600 hover:text-red-900">
                                        Xóa
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Empty State -->
        <div v-if="!loading && filteredUsers.length === 0" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Không tìm thấy người dùng</h3>
            <p class="mt-1 text-sm text-gray-500">Thử điều chỉnh bộ lọc hoặc tìm kiếm với từ khóa khác.</p>
        </div>
    </div>

    <!-- Pagination -->
    <div v-if="!loading && filteredUsers.length > 0"
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
                    <span class="font-medium">{{ filteredUsers.length }}</span>
                    kết quả
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
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
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
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
    <div v-if="!loading && filteredUsers.length > 0" class="mt-4 flex items-center justify-end">
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

    <!-- Add/Edit User Modal -->
    <UserModal />
</template>

<script setup>
import { ref, reactive, computed, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useUserStore } from "../../stores/useUserAdStore";
import UserModal from "../../components/UserModal.vue";

const router = useRouter()
const userStore = useUserStore();


// State
const searchQuery = ref('')
const selectedUsers = ref([])
const currentPage = ref(1)
const itemsPerPage = ref(25)
const loading = ref(false)
const showAddUserModal = ref(true)
const editingUser = ref(null)
const submitting = ref(false)

// Filters
const filters = reactive({
    role: '',
    status: '',
    dateFrom: '',
    dateTo: ''
})

// User form
const userForm = reactive({
    name: '',
    email: '',
    phone: '',
    role: 'user',
    password: ''
})

// Statistics - API INTEGRATION POINT
const stats = reactive({
    totalUsers: 0,
    activeUsers: 0,
    newUsersThisMonth: 0,
    premiumUsers: 0
})

// Mock data - sẽ được thay thế bằng API call
const users = ref([])

// Computed properties
const filteredUsers = computed(() => {
    let filtered = users.value

    // Search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase()
        filtered = filtered.filter(user =>
            user.name.toLowerCase().includes(query) ||
            user.email.toLowerCase().includes(query)
        )
    }

    // Role filter
    if (filters.role !== '') {
        filtered = filtered.filter(user => user.role === filters.role)
    }

    // Status filter
    if (filters.status !== '') {
        filtered = filtered.filter(user => user.is_active === (filters.status === '1'))
    }

    // Date range filter
    if (filters.dateFrom) {
        const fromDate = new Date(filters.dateFrom)
        filtered = filtered.filter(user => new Date(user.created_at) >= fromDate)
    }
    if (filters.dateTo) {
        const toDate = new Date(filters.dateTo)
        toDate.setHours(23, 59, 59, 999)
        filtered = filtered.filter(user => new Date(user.created_at) <= toDate)
    }

    return filtered
})

const totalPages = computed(() => Math.ceil(filteredUsers.value.length / itemsPerPage.value))

const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage.value)

const endIndex = computed(() => Math.min(startIndex.value + itemsPerPage.value, filteredUsers.value.length))

const paginatedUsers = computed(() => {
    return filteredUsers.value.slice(startIndex.value, endIndex.value)
})

const allSelected = computed(() =>
    selectedUsers.value.length === paginatedUsers.value.length && paginatedUsers.value.length > 0
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
const getRoleBadgeClass = (role) => {
    switch (role) {
        case 'admin':
            return 'bg-purple-100 text-purple-800'
        case 'user':
            return 'bg-blue-100 text-blue-800'
        default:
            return 'bg-gray-100 text-gray-800'
    }
}

const getRoleText = (role) => {
    switch (role) {
        case 'admin':
            return 'Admin'
        case 'user':
            return 'User'
        default:
            return 'Không xác định'
    }
}

const getStatusBadgeClass = (isActive) => {
    return isActive
        ? 'bg-green-100 text-green-800'
        : 'bg-yellow-100 text-yellow-800'
}

const formatDate = (date) => {
    return new Intl.DateTimeFormat('vi-VN').format(new Date(date))
}

const formatLastActive = (date) => {
    const now = new Date()
    const diff = now - new Date(date)
    const minutes = Math.floor(diff / 60000)
    const hours = Math.floor(diff / 3600000)
    const days = Math.floor(diff / 86400000)

    if (minutes < 60) return `${minutes} phút trước`
    if (hours < 24) return `${hours} giờ trước`
    if (days < 30) return `${days} ngày trước`
    return formatDate(date)
}

const toggleSelectAll = () => {
    if (allSelected.value) {
        selectedUsers.value = []
    } else {
        selectedUsers.value = paginatedUsers.value.map(user => user.id)
    }
}

const toggleUserSelection = (userId) => {
    const index = selectedUsers.value.indexOf(userId)
    if (index > -1) {
        selectedUsers.value.splice(index, 1)
    } else {
        selectedUsers.value.push(userId)
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
    filters.role = ''
    filters.status = ''
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

const bulkAction = async (action) => {
    if (selectedUsers.value.length === 0) return

    const actionText = action === 'activate' ? 'kích hoạt' : action === 'deactivate' ? 'vô hiệu hóa' : 'khóa'
    const confirmMessage = `Bạn có chắc muốn ${actionText} ${selectedUsers.value.length} người dùng đã chọn?`

    if (confirm(confirmMessage)) {
        try {
            // API INTEGRATION POINT - Bulk update users
            // await api.post('/admin/users/bulk-update', {
            //   userIds: selectedUsers.value,
            //   action: action
            // })

            // Mock update local state for demo
            selectedUsers.value.forEach(userId => {
                const user = users.value.find(u => u.id === userId)
                if (user) {
                    if (action === 'activate') user.is_active = true
                    else if (action === 'deactivate') user.is_active = false
                    // Note: Delete action sẽ được xử lý riêng
                }
            })

            selectedUsers.value = []
            alert(`${actionText} thành công!`)
        } catch (error) {
            console.error('Bulk action error:', error)
            alert('Có lỗi xảy ra. Vui lòng thử lại.')
        }
    }
}

const viewUser = (userId) => {
    router.push(`/admin/users/${userId}`)
}

const editUser = (userId) => {
    const user = users.value.find(u => u.id === userId)
    if (user) {
        editingUser.value = user
        userForm.name = user.name
        userForm.email = user.email
        userForm.phone = user.phone || ''
        userForm.role = user.role
        showAddUserModal.value = true
    }
}

const deleteUser = async (userId) => {
    if (confirm('Bạn có chắc muốn xóa người dùng này?')) {
        try {
            // API INTEGRATION POINT - Delete user
            // await api.delete(`/admin/users/${userId}`)

            // Mock delete for demo
            const index = users.value.findIndex(u => u.id === userId)
            if (index > -1) {
                users.value.splice(index, 1)
            }

            alert('Xóa người dùng thành công!')
        } catch (error) {
            console.error('Delete user error:', error)
            alert('Có lỗi xảy ra. Vui lòng thử lại.')
        }
    }
}

const closeUserModal = () => {
    showAddUserModal.value = false
    editingUser.value = null
    // Reset form
    userForm.name = ''
    userForm.email = ''
    userForm.phone = ''
    userForm.role = 'user'
    userForm.password = ''
}

const handleUserSubmit = async () => {
    console.log('Form data:', { ...userForm, editingUser: editingUser.value });
    submitting.value = true
    try {
        if (editingUser.value) {
            // API INTEGRATION POINT - Update user
            // await api.put(`/admin/users/${editingUser.value.id}`, {
            //   name: userForm.name,
            //   email: userForm.email,
            //   phone: userForm.phone,
            //   role: userForm.role
            // })

            // Update local state for demo
            const user = users.value.find(u => u.id === editingUser.value.id)
            if (user) {
                user.name = userForm.name
                user.email = userForm.email
                user.phone = userForm.phone
                user.role = userForm.role
            }

            alert('Cập nhật người dùng thành công!')
        } else {
            // API INTEGRATION POINT - Create user
            // const response = await api.post('/admin/users', {
            //   name: userForm.name,
            //   email: userForm.email,
            //   phone: userForm.phone,
            //   password: userForm.password,
            //   role: userForm.role
            // })

            // Mock create for demo
            const newUser = {
                id: Date.now(),
                name: userForm.name,
                email: userForm.email,
                phone: userForm.phone,
                avatar: `https://ui-avatars.com/api/?name=${userForm.name}&background=random`,
                role: userForm.role,
                is_active: true,
                created_at: new Date().toISOString(),
                last_active_at: new Date().toISOString()
            }
            users.value.push(newUser)

            alert('Thêm người dùng thành công!')
        }

        closeUserModal()
    } catch (error) {
        console.error('Submit user error:', error)
        alert('Có lỗi xảy ra. Vui lòng thử lại.')
    } finally {
        submitting.value = false
    }
}

// Fetch users data - API INTEGRATION POINT
const fetchUsers = async () => {
    loading.value = true
    try {
        // API INTEGRATION POINT - Fetch users with filters
        // const response = await api.get('/admin/users', {
        //   params: {
        //     search: searchQuery.value,
        //     role: filters.role,
        //     status: filters.status,
        //     date_from: filters.dateFrom,
        //     date_to: filters.dateTo,
        //     page: currentPage.value,
        //     per_page: itemsPerPage.value
        //   }
        // })

        // Mock data for demo
        const mockUsers = [
            {
                id: 1,
                name: 'Nguyễn Văn An',
                email: 'an.nguyen@example.com',
                phone: '0912345678',
                role: 'user',
                is_active: true,
                created_at: '2023-01-15T10:30:00Z',
                last_active_at: '2023-12-10T15:45:00Z'
            },
            {
                id: 2,
                name: 'Trần Thị Bình',
                email: 'binh.tran@example.com',
                phone: '0923456789',
                role: 'admin',
                is_active: true,
                created_at: '2023-02-20T09:15:00Z',
                last_active_at: '2023-12-10T14:30:00Z'
            }
            // ... thêm users khác
        ]

        users.value = mockUsers

        // Update stats based on fetched data
        stats.totalUsers = users.value.length
        stats.activeUsers = users.value.filter(u => u.is_active).length
        stats.newUsersThisMonth = users.value.filter(u => {
            const createdMonth = new Date(u.created_at).getMonth()
            const currentMonth = new Date().getMonth()
            return createdMonth === currentMonth
        }).length
        stats.premiumUsers = users.value.filter(u => u.role === 'premium').length // Nếu có premium users

    } catch (error) {
        console.error('Fetch users error:', error)
    } finally {
        loading.value = false
    }
}

// Fetch stats data - API INTEGRATION POINT
const fetchStats = async () => {
    try {
        // API INTEGRATION POINT - Fetch dashboard stats
        // const response = await api.get('/admin/dashboard/stats')
        // Object.assign(stats, response.data)

        // Mock stats for demo
        stats.totalUsers = 1247
        stats.activeUsers = 892
        stats.newUsersThisMonth = 156
        stats.premiumUsers = 342

    } catch (error) {
        console.error('Fetch stats error:', error)
    }
}

// Initialize
onMounted(() => {
    fetchUsers()
    fetchStats()
})

// Watch for changes
watch(itemsPerPage, () => {
    currentPage.value = 1
})
</script>