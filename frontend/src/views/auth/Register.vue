<template>
    <div class="min-h-screen flex bg-gray-50">
        <!-- Left: Illustration (ẩn trên mobile) -->
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-600 items-center justify-center p-12">
            <div class="max-w-md text-center space-y-6">
                <svg class="mx-auto h-24 w-24 text-indigo-200" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                <h2 class="text-3xl font-bold text-white">Bắt đầu hành trình học lập trình</h2>
                <p class="text-indigo-200 text-lg">Tạo tài khoản miễn phí và truy cập hàng trăm khóa học chất lượng cao.
                </p>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="flex flex-1 items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Tạo tài khoản</h1>
                    <p class="mt-2 text-sm text-gray-500">Đăng ký để bắt đầu học ngay hôm nay</p>
                </div>

                <div class="rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 p-8">
                    <form @submit.prevent="handleSubmit" class="space-y-5">
                        <!-- General error -->
                        <div v-if="generalError"
                            class="rounded-lg bg-red-50 border border-red-200 p-3 text-sm text-red-700">
                            {{ generalError }}
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                            <input id="name" ref="nameRef" v-model="form.name" type="text" autocomplete="name"
                                placeholder="Nguyễn Văn A" :class="inputClass(errors.name)"
                                @blur="errors.name = validateName(form.name)" @input="errors.name = ''" />
                            <p v-if="errors.name" class="mt-1 text-xs text-red-600">{{ errors.name }}</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="email" v-model="form.email" type="email" autocomplete="email"
                                placeholder="you@example.com" :class="inputClass(errors.email)"
                                @blur="errors.email = validateEmail(form.email)" @input="errors.email = ''" />
                            <p v-if="errors.email" class="mt-1 text-xs text-red-600">{{ errors.email }}</p>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                            <div class="relative">
                                <input id="password" v-model="form.password" :type="showPassword ? 'text' : 'password'"
                                    autocomplete="new-password" placeholder="••••••••"
                                    :class="inputClass(errors.password)"
                                    @blur="errors.password = validatePassword(form.password)"
                                    @input="errors.password = ''" />
                                <button type="button"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors"
                                    @click="showPassword = !showPassword">
                                    <!-- Eye icon -->
                                    <svg v-if="!showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <!-- Eye-off icon -->
                                    <svg v-else class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            <p v-if="errors.password" class="mt-1 text-xs text-red-600">{{ errors.password }}</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Xác nhận
                                mật khẩu</label>
                            <div class="relative">
                                <input id="confirmPassword" v-model="form.confirmPassword"
                                    :type="showConfirm ? 'text' : 'password'" autocomplete="new-password"
                                    placeholder="••••••••" :class="inputClass(errors.confirmPassword)"
                                    @blur="errors.confirmPassword = validateConfirm(form.password, form.confirmPassword)"
                                    @input="errors.confirmPassword = ''" />
                                <button type="button"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors"
                                    @click="showConfirm = !showConfirm">
                                    <svg v-if="!showConfirm" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg v-else class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            <p v-if="errors.confirmPassword" class="mt-1 text-xs text-red-600">{{ errors.confirmPassword
                            }}</p>
                        </div>

                        <!-- Submit -->
                        <button type="submit" :disabled="isSubmitting" :class="[
                            'relative w-full rounded-lg px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200',
                            isSubmitting
                                ? 'bg-indigo-400 cursor-not-allowed'
                                : 'bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] shadow-sm hover:shadow',
                        ]">
                            <span :class="{ 'opacity-0': isSubmitting }">Đăng ký</span>
                            <span v-if="isSubmitting" class="absolute inset-0 flex items-center justify-center">
                                <svg class="h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>

                <p class="text-center text-sm text-gray-500">
                    Đã có tài khoản?
                    <router-link to="/signin"
                        class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                        Đăng nhập
                    </router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, inject } from 'vue'
import axios from '../../router/api.js'
import { useRouter } from 'vue-router'

const router = useRouter()
const toaster = inject('toast')

const nameRef = ref(null)
const isSubmitting = ref(false)
const generalError = ref('')
const showPassword = ref(false)
const showConfirm = ref(false)

const form = reactive({
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
})

const errors = reactive({
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
})

// ===== VALIDATION =====
function validateName(v) {
    if (!v.trim()) return 'Vui lòng nhập họ tên'
    if (v.trim().length < 2) return 'Họ tên tối thiểu 2 ký tự'
    return ''
}

function validateEmail(v) {
    if (!v.trim()) return 'Vui lòng nhập email'
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) return 'Email không đúng định dạng'
    return ''
}

function validatePassword(v) {
    if (!v) return 'Vui lòng nhập mật khẩu'
    if (v.length < 6) return 'Mật khẩu tối thiểu 6 ký tự'
    return ''
}

function validateConfirm(pw, cf) {
    if (!cf) return 'Vui lòng xác nhận mật khẩu'
    if (pw !== cf) return 'Mật khẩu không khớp'
    return ''
}

function validateAll() {
    errors.name = validateName(form.name)
    errors.email = validateEmail(form.email)
    errors.password = validatePassword(form.password)
    errors.confirmPassword = validateConfirm(form.password, form.confirmPassword)

    return !errors.name && !errors.email && !errors.password && !errors.confirmPassword
}

// ===== UI CLASS =====
function inputClass(error) {
    return [
        'block w-full rounded-lg px-3.5 py-2.5 text-sm',
        'outline-none transition-all duration-200',
        'focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500',
        error
            ? 'border-red-400 bg-red-50'
            : 'border-gray-300 bg-white hover:border-indigo-400',
    ]
}

// ===== SUBMIT =====
async function handleSubmit() {
    generalError.value = ''

    if (!validateAll()) return

    isSubmitting.value = true

    try {
        const res = await axios.post('/auth/register', {
            name: form.name.trim(),
            email: form.email.trim(),
            password: form.password,
            confirmPassword: form.confirmPassword,
        })

        toaster.success(res.data.message || 'Đăng ký thành công!')

        router.push({
            path: '/verify-otp',
            query: { email: form.email }
        })

    } catch (err) {
        isSubmitting.value = false
        const res = err.response

        if (res?.status === 422 && res.data?.errors) {
            const error = res.data.errors

            Object.keys(errors).forEach((key) => {
                errors[key] = error[key]?.[0] || ''
            })

            const firstError = Object.values(error)[0]?.[0]
            if (firstError) toaster.show(firstError)

        } else {
            const msg = res?.data?.message || 'Đăng ký thất bại'
            generalError.value = msg
            toaster.show(msg)
        }
    }
}

onMounted(() => {
    toaster.show('Chào mừng bạn đến với hệ thống học lập trình 🚀')
    nameRef.value?.focus()
})
</script>