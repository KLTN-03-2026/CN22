// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth.js'
import { initFlowbite } from 'flowbite'

// Client Views
const HomeView = () => import('../views/client/HomeView.vue')
const AboutView = () => import('../views/client/AboutView.vue')
const ContactView = () => import('../views/client/ContactView.vue')
const CoursesView = () => import('../views/client/CoursesView.vue')
const CourseDetailView = () => import('../views/client/CourseDetailView.vue')
const LearningView = () => import('../views/client/LearningView.vue')
const ProfileView = () => import('../views/client/ProfileView.vue')
// // Admin Views
const AdminDashboardView = () => import('../views/admin/DashboardView.vue')
const AdminCoursesView = () => import('../views/admin/CoursesView.vue')



// // Auth Views
// const LoginView = () => import('../views/auth/LoginView.vue')
const RegisterView = () => import('../views/auth/RegisterView.vue')
const ForgotPasswordView = () => import('../views/auth/ForgotPasswordView.vue')

const routes = [
    {
        path: '/',
        component: () => import('../layouts/ClientLayout.vue'),
        meta: { layout: 'client' },
        children: [
            {
                path: '',
                component: HomeView,
                meta: { title: 'Trang chủ - ZestCode' }
            },
            {
                path: 'about',
                component: AboutView,
                meta: { title: 'About ZestCode' }
            },
            {
                path: 'contact',
                component: ContactView,
                meta: { title: 'Contact ZestCode' }
            },
            {
                path: 'courses',
                name: 'courses',
                component: CoursesView,
                meta: { title: 'Khóa học - ZestCode' }
            },
            {
                path: 'courses/:slug',
                name: 'course-detail',
                component: CourseDetailView,
                meta: { title: 'Chi tiết khóa học', requiresAuth: true }
            },
            {
                path: '/learn/:slug/:lessonId',
                name: 'learning',
                component: LearningView,
                meta: { title: 'Chi tiết bài học', requiresAuth: true }
            },
            {
                path: 'profile',
                name: 'profile',
                component: ProfileView,
                meta: { title: 'Hồ sơ cá nhân' }
            },
            // {
            //     path: 'courses/:courseId/lessons/:lessonId',
            //     name: 'lesson',
            //     component: LessonView,
            //     meta: { title: 'Bài học' }
            // },
            // {
            //     path: '/auth/logout',
            //     component: LogoutView,
            //     meta: { title: 'Đăng xuất' }
            // },
        ]
    },

    // Admin Routes - Nested với AdminLayout
    {
        path: '/admin',
        component: () => import('../layouts/AdminLayout.vue'),
        meta: { layout: 'admin' },
        children: [
            {
                path: '',
                redirect: '/admin/dashboard'
            },
            {
                path: 'dashboard',
                name: 'admin-dashboard',
                component: AdminDashboardView,
                meta: {
                    title: 'Dashboard - Admin',
                    // requiresAuth: true,
                    // requiresAdmin: true
                }
            },
            {
                path: 'courses',
                name: 'admin-courses',
                component: AdminCoursesView,
                meta: {
                    title: 'Quản lý khóa học',
                    requiresAuth: true,
                    requiresAdmin: true
                }
            },
            {
                path: 'courses/create',
                component: () => import('../views/admin/CourseCreateView.vue'),
                meta: {
                    title: 'Quản lý khóa học',
                    requiresAuth: true,
                    requiresAdmin: true
                }
            },
            {
                path: 'courses/:id/edit',
                component: () => import('../views/admin/CourseEditView.vue'),
                meta: {
                    title: 'Quản lý khóa học',
                    requiresAuth: true,
                    requiresAdmin: true
                }
            },
            {
                path: 'courses/:id/builder',
                component: () => import('../views/admin/CourseBuilderView.vue'),
                meta: {
                    title: 'Quản lý khóa học',
                    requiresAuth: true,
                    requiresAdmin: true
                }
            }

            // {
            //     path: 'courses',
            //     name: 'admin-courses',
            //     component: ,
            //     meta: {
            //         title: 'Quản lý khóa học',
            //         requiresAuth: true,
            //         role: 'admin'
            //     }
            // },
        ]
    },

    // Auth Routes (Blank Layout)
    {
        path: '/',
        component: () => import('../layouts/BlankLayout.vue'),
        meta: { layout: 'blank' },
        children: [
            {
                path: 'auth/login',
                name: 'login',
                component: () => import('../views/auth/LoginView.vue'),
                meta: { title: 'Đăng nhập - ZestCode' }
            },
            {
                path: 'auth/register',
                name: 'register',
                component: RegisterView,
                meta: { title: 'Đăng ký - ZestCode', requiresGuest: true }
            },
            {
                path: 'forgot-password',
                component: ForgotPasswordView,
                meta: { title: 'Quên mật khẩu - ZestCode'}
            },
            {
                path: 'reset-password',
                component: ForgotPasswordView,
                meta: { title: 'Quên mật khẩu - ZestCode'}
            },
        ]
    },

    // 404 Route
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: () => import('../views/NotFoundView.vue'),
        meta: { layout: 'blank', title: 'Không tìm thấy trang' }
    },
    {
        path: '/test/:slug',
        component: () => import('../views/test.vue'),
        meta: { layout: 'blank', title: 'Không tìm thấy trang' }
    },
        {
        path: '/test',
        component: () => import('../views/test2.vue'),
        meta: { layout: 'blank', title: 'Không tìm thấy trang' }
    },
        {
        path: '/dash',
        component: () => import('../views/dash.vue'),
        meta: { layout: 'blank', title: 'Không tìm thấy trang' }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { top: 0 }
        }
    }
})

router.afterEach(() => {
    setTimeout(() => {
        initFlowbite()
    }, 100)
})

export { router }

// Global Navigation Guard (sẽ hoàn thiện sau khi có Auth Store)
router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore()

    if (!authStore.isInitialized) {
        await authStore.initializeAuth()
    }

    // Set document title
    document.title = to.meta.title || 'ZestCode - Học lập trình hiệu quả'

    if (to.meta.requiresGuest && authStore.isAuthenticated) {
        return next('/')
    }

    if (to.meta.requiresAuth && !authStore.isAuthenticated) {
        return next({
            name: 'login',
            query: { redirect: to.fullPath }
        })
    }

    if (to.meta.requiresAdmin && !authStore.isAdmin) {
        return next('/')
    }

    next()
})