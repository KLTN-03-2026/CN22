<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Top Navigation Bar -->
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo & Mobile Menu Button -->
                    <div class="flex items-center">
                        <!-- Mobile Menu Button -->
                        <button @click="toggleSidebar"
                            class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition mr-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path v-if="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <!-- Logo -->
                        <router-link to="/admin" class="flex items-center gap-2 shrink-0">
                            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-sm">&lt;/&gt;</span>
                            </div>
                            <span class="text-xl font-bold text-gray-900">ZestCode Admin</span>
                        </router-link>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center gap-1">
                        <router-link v-for="link in topNavLinks" :key="link.path" :to="link.path"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                            active-class="bg-indigo-50 text-indigo-600">
                            {{ link.name }}
                        </router-link>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center gap-3">
                        <!-- Search Bar (Desktop) -->
                        <div class="hidden md:block relative">
                            <input type="text" placeholder="Tìm kiếm..."
                                class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <!-- Notifications -->
                        <button class="relative p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User Profile Dropdown -->
                        <div class="relative group">
                            <div
                                class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm cursor-pointer hover:bg-indigo-200 transition">
                                {{ auth.user?.name?.charAt(0) || 'A' }}
                            </div>

                            <!-- Dropdown Menu -->
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white border rounded-xl shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none group-hover:pointer-events-auto">
                                <div class="px-4 py-3 border-b">
                                    <p class="text-sm font-medium text-gray-900">{{ auth.user?.name || 'Admin User' }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ auth.user?.email || 'admin@zestcode.dev' }}</p>
                                </div>
                                <router-link to="/admin/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    Hồ sơ
                                </router-link>
                                <router-link to="/admin/settings"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    Cài đặt
                                </router-link>
                                <button @click="handleLogout"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-xl">
                                    Đăng xuất
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar & Main Content -->
        <div class="flex">
            <!-- Sidebar -->
            <aside :class="[
                'bg-white shadow-md h-screen sticky top-16 transition-all duration-300 z-40',
                sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0',
                'w-64'
            ]">
                <div class="p-4 h-full overflow-y-auto">
                    <div class="space-y-6">
                        <!-- Dashboard Section -->
                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dashboard</h3>
                            <div class="mt-3 space-y-1">
                                <router-link to="/admin"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Tổng quan
                                </router-link>
                            </div>
                        </div>

                        <!-- Content Management -->
                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quản lý nội
                                dung</h3>
                            <div class="mt-3 space-y-1">
                                <router-link to="/admin/courses"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Khóa học
                                </router-link>

                                <router-link to="/admin/chapters"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Chương học
                                </router-link>

                                <router-link to="/admin/lessons"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Bài học
                                </router-link>

                                <router-link to="/admin/quizzes"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    Quiz
                                </router-link>
                            </div>
                        </div>

                        <!-- User Management -->
                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quản lý người
                                dùng</h3>
                            <div class="mt-3 space-y-1">
                                <router-link to="/admin/users"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Người dùng
                                </router-link>

                                <router-link to="/admin/progress"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Tiến độ học tập
                                </router-link>
                            </div>
                        </div>

                        <!-- Finance -->
                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tài chính</h3>
                            <div class="mt-3 space-y-1">
                                <router-link to="/admin/payments"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Thanh toán
                                </router-link>

                                <router-link to="/admin/revenue"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Doanh thu
                                </router-link>
                            </div>
                        </div>

                        <!-- Settings -->
                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Cài đặt</h3>
                            <div class="mt-3 space-y-1">
                                <router-link to="/admin/settings"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors"
                                    active-class="bg-indigo-50 text-indigo-600" @click="closeSidebar">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Cài đặt chung
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="py-6">
                    <RouterView />
                </div>
            </main>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div v-if="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden" @click="closeSidebar"></div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '../stores/useAuthStore'

const sidebarOpen = ref(false)
const auth = useAuthStore()

// Top navigation links
const topNavLinks = [
    { name: 'Tổng quan', path: '/admin' },
    { name: 'Báo cáo', path: '/admin/reports' },
    { name: 'Trang chủ', path: '/' }
]

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value
}

const closeSidebar = () => {
    sidebarOpen.value = false
}

const handleLogout = () => {
    auth.logout()
}

onMounted(() => {
    if (auth.token && !auth.user) {
        auth.fetchUser()
    }
})
</script>