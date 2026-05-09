<!-- src/layouts/AdminLayout.vue -->
<template>
    <button type="button" class="btn btn-text max-sm:btn-square sm:hidden" aria-haspopup="dialog"
        aria-expanded="false" aria-controls="collapsible-mini-sidebar" data-overlay="#collapsible-mini-sidebar">
        <span class="icon-[tabler--menu-2] size-5"></span>
    </button>

    <aside id="collapsible-mini-sidebar"
        class="overlay [--auto-close:sm] overlay-minified:w-17  sm:shadow-none overlay-open:translate-x-0 drawer drawer-start hidden w-66 sm:absolute sm:z-0 sm:flex sm:translate-x-0 border-e border-base-content/20"
        role="dialog" tabindex="-1">

        <div class="drawer-header  overlay-minified:px-3.75 py-2 w-full flex items-center justify-between gap-3">
            <h3 class="drawer-title text-xl font-semibold overlay-minified:hidden">FlyonUI</h3>
            <div class="hidden sm:block">
                <!-- Toggle Button -->
                <button type="button" class="btn btn-circle btn-text btn-white" aria-haspopup="dialog" aria-expanded="false"
                    aria-controls="collapsible-mini-sidebar" aria-label="Minify navigation"
                    data-overlay-minifier="#collapsible-mini-sidebar">
                    <span class="icon-[tabler--menu-2] size-5"></span>
                    <span class="sr-only">Navigation Toggle</span>
                </button>
                <!-- End Toggle Button -->
            </div>
        </div>
        <div class="drawer-body px-2 pt-4">
            <ul class="menu p-0">
                <li>
                    <a href="#">
                        <span class="icon-[tabler--home] size-5"></span>
                        <span class="overlay-minified:hidden">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon-[tabler--user] size-5"></span>
                        <span class="overlay-minified:hidden">Account</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon-[tabler--message] size-5"></span>
                        <span class="overlay-minified:hidden">Notifications</span>
                    </a>
                </li>
                <li
                    class="dropdown relative [--adaptive:none] [--strategy:static] overlay-minified:[--adaptive:adaptive] overlay-minified:[--strategy:fixed] overlay-minified:[--offset:15] overlay-minified:[--trigger:hover] overlay-minified:[--placement:right-start]">
                    <button id="dropdown-default" type="button" class="dropdown-toggle" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <span class="icon-[tabler--apps] size-5"></span>
                        <span class="overlay-minified:hidden">Apps</span>
                        <span
                            class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4 overlay-minified:hidden"></span>
                    </button>
                    <ul class="dropdown-menu mt-0 shadow-none overlay-minified:shadow-md overlay-minified:shadow-base-300/20 dropdown-open:opacity-100 hidden min-w-60 overlay-minified:before:absolute overlay-minified:before:-start-4 overlay-minified:before:top-0 overlay-minified:before:h-full overlay-minified:before:w-4 before:bg-transparent"
                        role="menu" aria-orientation="vertical" aria-labelledby="dropdown-default">
                        <li>
                            <a href="#">
                                <span class="icon-[tabler--mail] size-5"></span>
                                Email
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon-[tabler--calendar] size-5"></span>
                                Calendar
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="icon-[tabler--shopping-bag] size-5"></span>
                        <span class="overlay-minified:hidden">Product</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon-[tabler--login] size-5"></span>
                        <span class="overlay-minified:hidden">Sign In</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon-[tabler--logout-2] size-5"></span>
                        <span class="overlay-minified:hidden">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="min-h-screen bg-pink-50 flex">
        <!-- Sidebar -->
        <!-- <aside
            class="w-68 bg-white border-r border-gray-300 flex flex-col h-screen sticky top-0 shadow-sm rounded-full">
            <div class="px-6 py-4 border-b border-indigo-200">
                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-xl">
                        Z
                    </div>
                    <div class="font-bold text-2xl tracking-tight text-indigo-600">ZestCode</div>
                </div>
                <p class="text-xs text-neutral-500 mt-1">Quản trị viên</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <router-link to="/admin/dashboard"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-2xl hover:bg-neutral-100 transition-all duration-200"
                    :class="{
                        'bg-primary text-white shadow-sm': $route.path.startsWith('/admin/dashboard'),
                        'text-indigo-700': !$route.path.startsWith('/admin/dashboard')
                    }">
                    <i class="fas fa-chart-line w-5 text-center"></i>
                    <span>Tổng quan</span>
                </router-link>

                <router-link to="/admin/courses"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-2xl hover:bg-neutral-100 transition-all duration-200"
                    :class="{
                        'bg-primary text-white shadow-sm': $route.path.startsWith('/admin/courses'),
                        'text-indigo-700': !$route.path.startsWith('/admin/courses')
                    }">
                    <i class="fas fa-book w-5 text-center"></i>
                    <span>Quản lý khóa học</span>
                </router-link>

                <router-link to="/admin/users"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-2xl hover:bg-neutral-100 transition-all duration-200"
                    :class="{
                        'bg-primary text-white shadow-sm': $route.path.startsWith('/admin/users'),
                        'text-indigo-700': !$route.path.startsWith('/admin/users')
                    }">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span>Quản lý người dùng</span>
                </router-link>

                <router-link to="/admin/lessons"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-2xl hover:bg-neutral-100 transition-all duration-200"
                    :class="{
                        'bg-primary text-white shadow-sm': $route.path.startsWith('/admin/lessons'),
                        'text-indigo-700': !$route.path.startsWith('/admin/lessons')
                    }">
                    <i class="fas fa-file-lines w-5 text-center"></i>
                    <span>Quản lý bài học</span>
                </router-link>
            </nav>

            <div class="p-4 border-t border-gray-300">
                <div
                    class="flex items-center gap-3 px-4 py-3 bg-neutral-50 rounded-2xl hover:bg-neutral-100 transition-colors cursor-pointer">
                    <div class="w-9 h-9 bg-neutral-300 rounded-2xl overflow-hidden flex items-center justify-center">
                        <img src="https://i.pravatar.cc/128" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-primary truncate">Admin</p>
                        <p class="text-xs text-primary">admin@zestcode.vn</p>
                    </div>
                    <i class="fas fa-chevron-right text-primary text-xs"></i>
                </div>
            </div>
        </aside> -->

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-gray-300 px-8 flex items-center justify-between shadow-sm">
                <h1 class="text-xl font-semibold text-neutral-900">
                    {{ $route.meta.title || 'Admin Dashboard' }}
                </h1>
            </header>

            <!-- Page Content -->
            <main class="flex-1 px-8 py-3 overflow-auto">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script setup>
// AdminLayout - Sidebar trái cố định
</script>