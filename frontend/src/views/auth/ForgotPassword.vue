<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div
            class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-0 rounded-3xl overflow-hidden shadow-2xl bg-white">

            <!-- === BÊN TRÁI: HÌNH ẢNH / MINH HỌA (lg:col-span-7) === -->
            <div
                class="hidden lg:flex lg:col-span-6 bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-600 items-center justify-center p-12 relative overflow-hidden">

                <!-- Background decorative circles -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute -left-20 -top-20 w-80 h-80 rounded-full bg-white blur-3xl"></div>
                    <div class="absolute -right-32 bottom-12 w-96 h-96 rounded-full bg-white blur-3xl"></div>
                </div>

                <div class="relative z-10 max-w-md text-center text-white ">
                    <p class="text-xl text-indigo-100 mb-10">
                        Đừng lo lắng! Chúng tôi sẽ gửi mã xác nhận về email của bạn chỉ trong vài giây.
                    </p>

                    <!-- Minh họa SVG -->
                    <div class="mx-auto relative w-80 h-80 flex items-center justify-center">
                        <!-- Envelope -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-80 h-80 text-white/90 drop-shadow-2xl"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2.01 2.01 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2" />
                        </svg>

                        <!-- Padlock -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute w-40 h-40 text-white translate-y-8 drop-shadow-2xl" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 5.25a3 3 0 00-6 0v3.75m-3 0H4.5a2.25 2.25 0 00-2.25 2.25v7.5a2.25 2.25 0 002.25 2.25h13.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25H12v-3.75z" />
                        </svg>
                    </div>

                    <p class="text-sm text-indigo-200 mt-10 flex items-center justify-center gap-2">
                        <span class="inline-block w-2.5 h-2.5 bg-green-400 rounded-full animate-pulse"></span>
                        Mã xác nhận sẽ được gửi trong vòng 1 phút
                    </p>
                </div>
            </div>

            <!-- === BÊN PHẢI: FORM (lg:col-span-5) === -->
            <div class="lg:col-span-6 flex items-center justify-center p-6 lg:p-12">
                <div class="w-full max-w-md space-y-8">

                    <!-- Header -->
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-gray-900">Quên mật khẩu</h1>
                        <p class="text-gray-500 mt-2">Nhập email để nhận mã xác nhận</p>
                    </div>

                    <!-- Card Form -->
                    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">

                        <div v-if="success"
                            class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-2xl mb-6 flex items-start gap-3">
                            <span class="text-2xl mt-0.5">📧</span>
                            <div>{{ success }}</div>
                        </div>

                        <div v-if="error"
                            class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl mb-6 flex items-start gap-3">
                            <div>{{ error }}</div>
                        </div>

                        <form @submit.prevent="handleSubmit" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ email của
                                    bạn</label>
                                <div class="relative">
                                    <div
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                        ✉️
                                    </div>
                                    <input v-model="email" type="email" placeholder="you@example.com"
                                        class="w-full pl-12 pr-5 py-4 border border-gray-200 rounded-2xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all text-base" />
                                </div>
                            </div>

                            <button :disabled="loading"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white py-4 rounded-2xl font-semibold text-base transition-all flex items-center justify-center gap-2 shadow-md">
                                <span v-if="loading"
                                    class="animate-spin inline-block w-5 h-5 border-2 border-white border-t-transparent rounded-full"></span>
                                {{ loading ? 'Đang gửi mã...' : 'Gửi mã xác nhận' }}
                            </button>
                        </form>
                    </div>

                    <!-- Link quay lại -->
                    <router-link to="/signin"
                        class="block text-center text-sm text-indigo-600 hover:text-indigo-700 hover:underline flex items-center justify-center gap-1.5 transition-colors">
                        ← Quay lại trang đăng nhập
                    </router-link>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
// import api from '@/api'

const email = ref('')
const loading = ref(false)
const error = ref('')
const success = ref('')

const handleSubmit = async () => {
    error.value = ''
    success.value = ''

    if (!email.value) {
        error.value = 'Vui lòng nhập email'
        return
    }

    loading.value = true

    try {
        // !!! NƠI TÍCH HỢP AXIOS THỰC TẾ !!!
        // await api.post('/auth/forgot-password', { email: email.value })

        await new Promise(r => setTimeout(r, 1200))

        success.value = '✅ Email đã được gửi! Vui lòng kiểm tra hộp thư (có thể vào spam).'
    } catch (e) {
        error.value = 'Không thể gửi yêu cầu. Vui lòng thử lại sau.'
    } finally {
        loading.value = false
    }
}
</script>