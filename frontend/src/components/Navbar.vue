<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '../stores/useAuthStore'

const isMenuOpen = ref(false)
const auth = useAuthStore()

const navLinks = [
    { name: 'Khóa học', path: '/courses' },
    { name: 'Luyện tập', path: '/practice' },
    { name: 'Về chúng tôi', path: '/about' },
    { name: 'Liên hệ', path: '/contact' }
]

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
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

<template>
    <header class="sticky top-0 z-50">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">

                    <!-- Logo -->
                    <router-link to="/" class="flex items-center gap-2 shrink-0">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">&lt;/&gt;</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900">ZestCode</span>
                    </router-link>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-1">
                        <router-link v-for="link in navLinks" :key="link.path" :to="link.path"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                            active-class="bg-indigo-50 text-indigo-600">
                            {{ link.name }}
                        </router-link>
                    </div>

                    <!-- Right Side -->
                    <div class="hidden md:flex items-center gap-3">

                        <!-- Logged In -->
                        <template v-if="true">
                            <div class="flex items-center gap-3">
                                <div class="text-right hidden sm:block ">
                                    <p class="text-sm font-medium text-neutral-900">{{ auth.user?.name?.charAt(0) || 'U'
                                    }}</p>
                                    <p class="text-xs text-neutral-500">Học viên</p>
                                </div>
                                <div id=" dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                    class="inline-flex items-center justify-center focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base  focus:outline-none"
                                    type="button">
                                    <div class=" w-9 h-9 rounded-2xl overflow-hidden border border-neutral-300 bg-indigo-100
                                    flex items-center justify-center text-indigo-600 font-semibold text-sm
                                    cursor-pointer hover:bg-indigo-200 transition">
                                        <!-- Avatar placeholder -->
                                        <img src="https://i.pravatar.cc/128" alt="Avatar"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown"
                                        class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                                        <ul class="p-2 text-sm text-body font-medium"
                                            aria-labelledby="dropdownDefaultButton">
                                            <router-link to="/profile">
                                                <li>
                                                    <a
                                                        class="inline-flex items-center w-full p-2 hover:bg-indigo-50  hover:text-indigo-600 rounded"><i class="fa-solid fa-circle-user pe-5"></i>Tài khoản</a>
                                                </li>
                                            </router-link>
                                            <router-link to="/auth/logout">
                                                <li>
                                                    <a
                                                        class="inline-flex items-center w-full p-2 text-red-500 hover:bg-red-100  hover:text-red-500 rounded"><i
                                                            class="fa-solid fa-arrow-right-from-bracket pe-5"></i>Đăng
                                                        xuất</a>
                                                </li>
                                            </router-link>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Not Logged In -->
                        <template v-else>
                            <router-link to="/signin"
                                class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">
                                Đăng nhập
                            </router-link>

                            <router-link to="/signup"
                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                                Đăng ký
                            </router-link>
                        </template>
                    </div>

                    <!-- Mobile -->
                    <button class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition"
                        @click="toggleMenu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor">
                            <path v-if="!isMenuOpen" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div v-if="isMenuOpen" class="md:hidden border-t bg-white">
                <div class="px-4 py-3 space-y-2">

                    <router-link v-for="link in navLinks" :key="link.path" :to="link.path"
                        class="block px-4 py-2 rounded-lg text-sm" @click="isMenuOpen = false">
                        {{ link.name }}
                    </router-link>

                    <div class="pt-3 border-t">

                        <template v-if="auth.isAuthenticated">
                            <router-link to="/profile" class="block px-4 py-2 text-sm">
                                Hồ sơ
                            </router-link>

                            <button @click="handleLogout" class="block w-full text-left px-4 py-2 text-sm text-red-600">
                                Đăng xuất
                            </button>
                        </template>

                        <template v-else>
                            <router-link to="/signin" class="block px-4 py-2 text-sm">
                                Đăng nhập
                            </router-link>

                            <router-link to="/signup"
                                class="block px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg">
                                Đăng ký
                            </router-link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>