<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    Đăng nhập
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    Chào mừng bạn quay lại hệ thống học lập trình
                </p>
            </div>

            <!-- Card -->
            <div class="rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 p-8">
                <!-- Nút Google Custom UI -->
                <div class="">
                    <button @click="handleGoogleLogin"
                        class="flex w-full items-center justify-center gap-3 rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <!-- Google Icon SVG -->
                        <svg class="h-5 w-5" viewBox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                        Tiếp tục với Google
                    </button>
                </div>

                <!-- Đường kẻ chia cách (Tùy chọn) -->
                <div class="relative mt-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-2 text-gray-500">Hoặc</span>
                    </div>
                </div>
                <form @submit.prevent="handleSubmit" class="space-y-5">
                    <!-- General error -->
                    <div v-if="generalError"
                        class="rounded-lg bg-red-50 border border-red-200 p-3 text-sm text-red-700">
                        {{ generalError }}
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input id="email" ref="emailRef" v-model="form.email" type="email" autocomplete="email"
                            placeholder="you@example.com" :class="[
                                'block w-full rounded-lg border px-3.5 py-2.5 text-sm text-gray-900 placeholder-gray-400',
                                'outline-none transition-colors duration-150',
                                'focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500',
                                errors.email
                                    ? 'border-red-400 bg-red-50/40'
                                    : 'border-gray-300 bg-white hover:border-gray-400',
                            ]" @input="clearError('email')" />
                        <p v-if="errors.email" class="mt-1 text-xs text-red-600">
                            {{ errors.email }}
                        </p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Mật khẩu
                        </label>
                        <input id="password" v-model="form.password" type="password" autocomplete="current-password"
                            placeholder="••••••••" :class="[
                                'block w-full rounded-lg border px-3.5 py-2.5 text-sm text-gray-900 placeholder-gray-400',
                                'outline-none transition-colors duration-150',
                                'focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500',
                                errors.password
                                    ? 'border-red-400 bg-red-50/40'
                                    : 'border-gray-300 bg-white hover:border-gray-400',
                            ]" @input="clearError('password')" />
                        <p v-if="errors.password" class="mt-1 text-xs text-red-600">
                            {{ errors.password }}
                        </p>
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input v-model="form.remember" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition" />
                            <span class="text-sm text-gray-600">Ghi nhớ đăng nhập</span>
                        </label>
                        <router-link to="/forgot-password"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                            Quên mật khẩu?
                        </router-link>
                    </div>

                    <!-- Submit -->
                    <button type="submit" :disabled="isSubmitting" :class="[
                        'relative w-full rounded-lg px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200',
                        isSubmitting
                            ? 'bg-indigo-400 cursor-not-allowed'
                            : 'bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] shadow-sm hover:shadow',
                    ]">
                        <span :class="{ 'opacity-0': isSubmitting }">Đăng nhập</span>
                        <!-- Loading spinner -->
                        <span v-if="isSubmitting" class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4" />
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>

            <!-- Register link -->
            <p class="text-center text-sm text-gray-500">
                Chưa có tài khoản?
                <router-link to="/signup" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                    Đăng ký ngay
                </router-link>
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../../stores/useAuthStore'


const router = useRouter()
const auth = useAuthStore()

const emailRef = ref(null)
const isSubmitting = ref(false)
const generalError = ref('')

const form = reactive({
    email: '',
    password: '',
    remember: false,
})

const errors = reactive({
    email: '',
    password: '',
})

// ===== VALIDATION =====
function validateEmail(email) {
    if (!email.trim()) return 'Vui lòng nhập email'
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!re.test(email)) return 'Email không đúng định dạng'
    return ''
}

function validatePassword(password) {
    if (!password) return 'Vui lòng nhập mật khẩu'
    if (password.length < 6) return 'Mật khẩu tối thiểu 6 ký tự'
    return ''
}

function validate() {
    errors.email = validateEmail(form.email)
    errors.password = validatePassword(form.password)
    return !errors.email && !errors.password
}

function clearError(field) {
    errors[field] = ''
    generalError.value = ''
}

// ===== GOOGLE LOGIN =====
const handleGoogleLogin = () => {
    window.location.href = 'http://localhost:8000/api/auth/google'
}

// ===== HANDLE TOKEN FROM GOOGLE =====
const token = new URLSearchParams(window.location.search).get('token')

if (token) {
    localStorage.setItem('token', token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

    api.get('/')
        .then(() => {
            router.push("/")
        })
        .catch(() => {
            localStorage.removeItem('token')
            router.push('/signin')
        })
}
const handleSubmit = async () => {
    if (!validate()) return

    isSubmitting.value = true
    generalError.value = ''

    try {
        await auth.login({
            email: form.email,
            password: form.password
        })

        router.push("/")
    } catch (err) {
        generalError.value = err.response?.data?.message 
            || 'Đăng nhập thất bại. Vui lòng thử lại.'
    } finally {
        isSubmitting.value = false
    }
}

onMounted(() => {
    emailRef.value?.focus()

    // Nếu đã có token → thử lấy thông tin user
    if (auth.token) {
        auth.fetchUser().catch(() => {
            // token invalid → logout
        })
    }
})
</script>