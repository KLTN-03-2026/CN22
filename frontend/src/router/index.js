import { createWebHistory, createRouter } from 'vue-router'
import { requireStudent } from './check'

const routes = [
    {
        path: '/',
        component: () => import('../views/client/HomePage.vue'),
        name: 'home',
        meta: { layout: 'client' }
    },
    {
        path: '/profile',
        component: () => import('../views/client/ProfileView.vue'),
        name: 'profile',
        meta: { layout: 'client' }
    },
    {
        path: '/signin',
        component: () => import('../views/auth/signin.vue'),
        name: 'login',
        meta: { layout: 'blank' }
    },
    {
        path: '/signup',
        component: () => import('../views/auth/Register.vue'),
        name: 'signup',
        meta: { layout: 'blank' }
    },
    {
        path: '/auth/callback',
        component: () => import('../views/auth/AuthCallback.vue'),
        meta: { layout: 'blank' }
    },
    {
        path: '/verify-otp',
        component: () => import('../views/auth/VerifyOtp.vue'),
        meta: { layout: 'blank' },
        props: route => ({ userEmail: route.query.email })
    },
    {
        path: '/forgot-password',
        component: () => import('../views/auth/ForgotPassword.vue'),
        meta: { layout: 'client' },
    },
    {
        path: '/reset-password',
        component: () => import('../views/auth/ResetPassword.vue'),
        meta: { layout: 'client' },
    },

    {
        path: '/about',
        component: () => import('../views/client/About.vue'),
        name: 'about',
        meta: { layout: 'client' }
    },
    {
        path: '/contact',
        component: () => import('../views/client/Contact.vue'),
        name: 'contact',
        meta: { layout: 'client' }
    },
    {
        path: '/courses',
        component: () => import('../views/client/CourseList.vue'),
        name: 'course',
        meta: { layout: 'client' }
    },
    {
        path: '/courses/:slug',
        component: () => import('../views/client/CourseDetail.vue'),
        name: 'course-detail',
        meta: { layout: 'client' },
        props: true,
        beforeEnter: requireStudent
    },
    {
        path: '/courses/:slug/lessons/:id',
        name: 'lesson-detail',
        component: () => import('../views/client/LessonDetail.vue'),
        meta: { layout: 'client' },
        props: true,
        beforeEnter: requireStudent
    },

    {
        path: '/sos',
        component: () => import('../views/client/ExerciseCode.vue'),
        meta: { layout: 'client' },
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('../views/auth/NotFound.vue'),
        meta: { layout: 'blank' },
    }
]


export const router = createRouter({
    history: createWebHistory(),
    routes,
})