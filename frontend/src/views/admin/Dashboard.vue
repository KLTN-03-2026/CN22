<template>
    <div class="p-6 space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tổng quan</h1>
                <p class="mt-1 text-sm text-gray-500">Chào mừng trở lại! Đây là tổng quan về hoạt động của nền tảng.</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <button
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Xuất báo cáo
                </button>
                <button
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Thêm mới
                </button>
            </div>
        </div>

        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Tổng người dùng</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ stats.totalUsers }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        <svg class="self-center flex shrink-0 h-5 w-5 text-green-500"
                                            fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Increased by</span>
                                        {{ stats.newUsersToday }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-green-600 font-medium">{{ stats.userGrowthPercent }}%</span>
                        <span class="text-gray-500"> so với tuần trước</span>
                    </div>
                </div>
            </div>

            <!-- Active Courses Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Khóa học hoạt động</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ stats.activeCourses }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        <svg class="self-center flex shrink-0 h-5 w-5 text-green-500"
                                            fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Increased by</span>
                                        {{ stats.newCoursesThisMonth }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-green-600 font-medium">{{ stats.courseGrowthPercent }}%</span>
                        <span class="text-gray-500"> so với tháng trước</span>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Doanh thu tháng này</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{
                                        formatCurrency(stats.revenueThisMonth) }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold"
                                        :class="stats.revenueGrowthPercent >= 0 ? 'text-green-600' : 'text-red-600'">
                                        <svg v-if="stats.revenueGrowthPercent >= 0"
                                            class="self-center flex shrink-0 h-5 w-5 text-green-500" fill="currentColor"
                                            viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg v-else class="self-center flex shrink-0 h-5 w-5 text-red-500"
                                            fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L10 13.586l3.293-3.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">{{ stats.revenueGrowthPercent >= 0 ? 'Increased by' :
                                            'Decreased by' }}</span>
                                        {{ Math.abs(stats.revenueGrowthPercent) }}%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span :class="stats.revenueGrowthPercent >= 0 ? 'text-green-600' : 'text-red-600'"
                            class="font-medium">{{ stats.revenueGrowthPercent >= 0 ? '+' : '' }}{{
                                stats.revenueGrowthPercent }}%</span>
                        <span class="text-gray-500"> so với tháng trước</span>
                    </div>
                </div>
            </div>

            <!-- Completion Rate Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Tỷ lệ hoàn thành</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ stats.completionRate }}%</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold"
                                        :class="stats.completionRateChange >= 0 ? 'text-green-600' : 'text-red-600'">
                                        <svg v-if="stats.completionRateChange >= 0"
                                            class="self-center flex shrink-0 h-5 w-5 text-green-500" fill="currentColor"
                                            viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg v-else class="self-center flex shrink-0 h-5 w-5 text-red-500"
                                            fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L10 13.586l3.293-3.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">{{ stats.completionRateChange >= 0 ? 'Increased by' :
                                            'Decreased by' }}</span>
                                        {{ Math.abs(stats.completionRateChange) }}%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span :class="stats.completionRateChange >= 0 ? 'text-green-600' : 'text-red-600'"
                            class="font-medium">{{ stats.completionRateChange >= 0 ? '+' : '' }}{{
                                stats.completionRateChange }}%</span>
                        <span class="text-gray-500"> so với tháng trước</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Growth Chart -->
            <div class="bg-white p-6 shadow rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tăng trưởng người dùng</h3>
                    <div class="flex space-x-2">
                        <button @click="setUserGrowthPeriod('week')"
                            :class="userGrowthPeriod === 'week' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Tuần</button>
                        <button @click="setUserGrowthPeriod('month')"
                            :class="userGrowthPeriod === 'month' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Tháng</button>
                        <button @click="setUserGrowthPeriod('year')"
                            :class="userGrowthPeriod === 'year' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Năm</button>
                    </div>
                </div>
                <div class="h-64">
                    <!-- Simple Line Chart Simulation -->
                    <div class="relative h-full">
                        <div class="absolute inset-0 flex items-end justify-between">
                            <div v-for="(height, index) in userGrowthData" :key="index"
                                class="bg-blue-500 w-8 rounded-t" :style="{ height: `${height}%` }"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 flex justify-between text-xs text-gray-500 mt-1">
                            <span v-for="(label, index) in userGrowthLabels" :key="index">{{ label }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Chart -->
            <div class="bg-white p-6 shadow rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Doanh thu</h3>
                    <div class="flex space-x-2">
                        <button @click="setRevenuePeriod('week')"
                            :class="revenuePeriod === 'week' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Tuần</button>
                        <button @click="setRevenuePeriod('month')"
                            :class="revenuePeriod === 'month' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Tháng</button>
                        <button @click="setRevenuePeriod('year')"
                            :class="revenuePeriod === 'year' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Năm</button>
                    </div>
                </div>
                <div class="h-64">
                    <!-- Simple Bar Chart Simulation -->
                    <div class="relative h-full">
                        <div class="absolute inset-0 flex items-end justify-between">
                            <div v-for="(height, index) in revenueData" :key="index" class="bg-green-500 w-8 rounded-t"
                                :style="{ height: `${height}%` }"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 flex justify-between text-xs text-gray-500 mt-1">
                            <span v-for="(label, index) in revenueLabels" :key="index">{{ label }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Popularity Chart -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Phổ biến khóa học</h3>
                <div class="h-64 flex items-center justify-center">
                    <!-- Simple Pie Chart Simulation -->
                    <div class="relative w-48 h-48">
                        <div class="absolute inset-0 rounded-full" :style="pieChartStyle"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ coursePopularity.length }}</div>
                                <div class="text-xs text-gray-500">Khóa học</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <div v-for="(course, index) in coursePopularity" :key="index"
                        class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-2" :style="{ backgroundColor: course.color }"></div>
                            <span class="text-sm text-gray-700">{{ course.name }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ course.percentage }}%</span>
                    </div>
                </div>
            </div>

            <!-- Learning Progress Chart -->
            <div class="bg-white p-6 shadow rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tiến độ học tập</h3>
                    <div class="flex space-x-2">
                        <button @click="setProgressPeriod('week')"
                            :class="progressPeriod === 'week' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Tuần</button>
                        <button @click="setProgressPeriod('month')"
                            :class="progressPeriod === 'month' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Tháng</button>
                        <button @click="setProgressPeriod('year')"
                            :class="progressPeriod === 'year' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1 text-xs font-medium rounded-full">Năm</button>
                    </div>
                </div>
                <div class="h-64">
                    <!-- Simple Area Chart Simulation -->
                    <div class="relative h-full">
                        <div class="absolute inset-0">
                            <svg class="w-full h-full" viewBox="0 0 300 200" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#3B82F6" stop-opacity="0.6" />
                                        <stop offset="100%" stop-color="#3B82F6" stop-opacity="0.1" />
                                    </linearGradient>
                                </defs>
                                <path d="M0,150 C50,120 100,100 150,110 C200,120 250,80 300,100 L300,200 L0,200 Z"
                                    fill="url(#gradient)" />
                                <path d="M0,150 C50,120 100,100 150,110 C200,120 250,80 300,100" fill="none"
                                    stroke="#3B82F6" stroke-width="2" />
                            </svg>
                        </div>
                        <div
                            class="absolute bottom-0 left-0 right-0 flex justify-between text-xs text-gray-500 mt-1 px-2">
                            <span>T2</span>
                            <span>T3</span>
                            <span>T4</span>
                            <span>T5</span>
                            <span>T6</span>
                            <span>T7</span>
                            <span>CN</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities and Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activities -->
            <div class="lg:col-span-2 bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Hoạt động gần đây</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div v-for="activity in recentActivities" :key="activity.id" class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex shrink-0">
                                <img class="h-8 w-8 rounded-full" :src="activity.userAvatar" :alt="activity.userName">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">
                                    <span class="font-medium">{{ activity.userName }}</span>
                                    <span class="text-gray-500">{{ activity.action }}</span>
                                    <span class="font-medium">{{ activity.target }}</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ formatTime(activity.timestamp) }}</p>
                            </div>
                            <div class="flex shrink-0">
                                <span :class="getActivityBadgeClass(activity.type)"
                                    class="px-2 py-1 text-xs font-medium rounded-full">
                                    {{ activity.type }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-3 border-t border-gray-200">
                    <button class="text-sm font-medium text-blue-600 hover:text-blue-500">Xem tất cả hoạt động</button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Hành động nhanh</h3>
                </div>
                <div class="p-6 space-y-4">
                    <button @click="$router.push('/admin/courses/new')"
                        class="w-full flex items-center justify-center px-4 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Thêm khóa học mới
                    </button>
                    <button @click="$router.push('/admin/reports')"
                        class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v1a3 3 0 003 3h0a3 3 0 003-3v-1m-6 0h6m-6 0h.01M9 17h.01M15 17h.01M12 19v0m0-4v0m0-4v0m0-4h.01" />
                        </svg>
                        Xem báo cáo
                    </button>
                    <button @click="$router.push('/admin/users')"
                        class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Quản lý người dùng
                    </button>
                    <button @click="$router.push('/admin/settings')"
                        class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Cài đặt hệ thống
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'

// Chart periods
const userGrowthPeriod = ref('month')
const revenuePeriod = ref('month')
const progressPeriod = ref('month')

// Stats data
const stats = reactive({
    totalUsers: 2456,
    newUsersToday: 42,
    userGrowthPercent: 12.5,
    activeCourses: 18,
    newCoursesThisMonth: 3,
    courseGrowthPercent: 8.2,
    revenueThisMonth: 8750000,
    revenueGrowthPercent: 15.3,
    completionRate: 68.5,
    completionRateChange: 5.2
})

// Chart data
const userGrowthData = ref([65, 70, 80, 75, 85, 90, 88])
const userGrowthLabels = ref(['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'])

const revenueData = ref([45, 55, 40, 65, 70, 60, 75])
const revenueLabels = ref(['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'])

const coursePopularity = ref([
    { name: 'JavaScript Cơ bản', percentage: 35, color: '#3B82F6' },
    { name: 'React Nâng cao', percentage: 25, color: '#10B981' },
    { name: 'Node.js Backend', percentage: 20, color: '#F59E0B' },
    { name: 'Khác', percentage: 20, color: '#EF4444' }
])

// Pie chart style
const pieChartStyle = computed(() => {
    let currentAngle = 0
    const paths = coursePopularity.value.map(course => {
        const percentage = course.percentage
        const angle = (percentage / 100) * 360
        const startAngle = currentAngle
        const endAngle = currentAngle + angle
        currentAngle = endAngle

        const startAngleRad = (startAngle * Math.PI) / 180
        const endAngleRad = (endAngle * Math.PI) / 180

        const x1 = 50 + 50 * Math.cos(startAngleRad)
        const y1 = 50 + 50 * Math.sin(startAngleRad)
        const x2 = 50 + 50 * Math.cos(endAngleRad)
        const y2 = 50 + 50 * Math.sin(endAngleRad)

        const largeArcFlag = angle > 180 ? 1 : 0

        return `M50,50 L${x1},${y1} A50,50 0 ${largeArcFlag},1 ${x2},${y2} Z`
    }).join(' ')

    return {
        background: `conic-gradient(${coursePopularity.value.map(course => `${course.color} ${course.percentage}%`).join(', ')})`
    }
})

// Recent activities
const recentActivities = ref([
    {
        id: 1,
        userName: 'Nguyễn Văn An',
        userAvatar: 'https://picsum.photos/seed/user1/100/100.jpg',
        action: 'đã đăng ký khóa học',
        target: 'JavaScript Cơ bản',
        type: 'enrollment',
        timestamp: new Date(Date.now() - 1000 * 60 * 5) // 5 minutes ago
    },
    {
        id: 2,
        userName: 'Trần Thị Bình',
        userAvatar: 'https://picsum.photos/seed/user2/100/100.jpg',
        action: 'đã hoàn thành bài học',
        target: 'React Hooks',
        type: 'completion',
        timestamp: new Date(Date.now() - 1000 * 60 * 15) // 15 minutes ago
    },
    {
        id: 3,
        userName: 'Lê Văn Cường',
        userAvatar: 'https://picsum.photos/seed/user3/100/100.jpg',
        action: 'đã thanh toán',
        target: 'Node.js Backend',
        type: 'payment',
        timestamp: new Date(Date.now() - 1000 * 60 * 30) // 30 minutes ago
    },
    {
        id: 4,
        userName: 'Phạm Thị Dung',
        userAvatar: 'https://picsum.photos/seed/user4/100/100.jpg',
        action: 'đã nộp bài quiz',
        target: 'JavaScript Cơ bản - Bài 5',
        type: 'quiz',
        timestamp: new Date(Date.now() - 1000 * 60 * 45) // 45 minutes ago
    },
    {
        id: 5,
        userName: 'Hoàng Văn Em',
        userAvatar: 'https://picsum.photos/seed/user5/100/100.jpg',
        action: 'đã đăng ký tài khoản',
        target: '',
        type: 'registration',
        timestamp: new Date(Date.now() - 1000 * 60 * 60) // 1 hour ago
    }
])

// Methods
const formatCurrency = (amount) => {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        minimumFractionDigits: 0
    }).format(amount)
}

const formatTime = (timestamp) => {
    const now = new Date()
    const diff = now - timestamp
    const minutes = Math.floor(diff / 60000)
    const hours = Math.floor(diff / 3600000)
    const days = Math.floor(diff / 86400000)

    if (minutes < 60) return `${minutes} phút trước`
    if (hours < 24) return `${hours} giờ trước`
    return `${days} ngày trước`
}

const getActivityBadgeClass = (type) => {
    switch (type) {
        case 'enrollment':
            return 'bg-blue-100 text-blue-800'
        case 'completion':
            return 'bg-green-100 text-green-800'
        case 'payment':
            return 'bg-yellow-100 text-yellow-800'
        case 'quiz':
            return 'bg-purple-100 text-purple-800'
        case 'registration':
            return 'bg-indigo-100 text-indigo-800'
        default:
            return 'bg-gray-100 text-gray-800'
    }
}

const setUserGrowthPeriod = (period) => {
    userGrowthPeriod.value = period
    // In a real app, this would fetch new data based on the period
    updateChartData()
}

const setRevenuePeriod = (period) => {
    revenuePeriod.value = period
    // In a real app, this would fetch new data based on the period
    updateChartData()
}

const setProgressPeriod = (period) => {
    progressPeriod.value = period
    // In a real app, this would fetch new data based on the period
    updateChartData()
}

const updateChartData = () => {
    // Mock data update based on period
    // In a real app, this would be an API call
    if (userGrowthPeriod.value === 'week') {
        userGrowthData.value = [30, 35, 40, 38, 42, 45, 43]
        userGrowthLabels.value = ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN']
    } else if (userGrowthPeriod.value === 'month') {
        userGrowthData.value = [65, 70, 80, 75, 85, 90, 88]
        userGrowthLabels.value = ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN']
    } else {
        userGrowthData.value = [40, 45, 55, 60, 70, 80, 85, 90, 88, 92, 95, 98]
        userGrowthLabels.value = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12']
    }

    // Similar updates for other charts
    if (revenuePeriod.value === 'week') {
        revenueData.value = [25, 30, 28, 35, 40, 38, 42]
    } else if (revenuePeriod.value === 'month') {
        revenueData.value = [45, 55, 40, 65, 70, 60, 75]
    } else {
        revenueData.value = [30, 35, 45, 50, 60, 65, 70, 75, 80, 85, 90, 95]
    }
}

// Initialize data on mount
onMounted(() => {
    updateChartData()
})
</script>