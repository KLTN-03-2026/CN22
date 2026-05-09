<template>
    <div class="w-full max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Đặt lại mật khẩu</h1>
            <p class="text-gray-500 mt-2">Nhập mật khẩu mới cho tài khoản của bạn</p>
        </div>

        <div v-if="success" class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6">
            {{ success }}
        </div>

        <div v-if="error" class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6">
            {{ error }}
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                <div class="relative">
                    <input v-model="password" :type="showPassword ? 'text' : 'password'" placeholder="Nhập mật khẩu mới"
                        class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all" />
                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        {{ showPassword ? '🙈' : '👁' }}
                    </button>
                </div>
                <p v-if="passwordError" class="text-red-500 text-xs mt-1.5">{{ passwordError }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu</label>
                <input v-model="confirmPassword" :type="showPassword ? 'text' : 'password'"
                    placeholder="Nhập lại mật khẩu"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all" />
                <p v-if="confirmError" class="text-red-500 text-xs mt-1.5">{{ confirmError }}</p>
            </div>

            <button :disabled="loading"
                class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white py-3 rounded-xl font-semibold transition-all">
                {{ loading ? 'Đang xử lý...' : 'Đặt lại mật khẩu' }}
            </button>
        </form>

        <div class="text-center mt-6">
            <router-link to="/signin" class="text-sm text-indigo-600 hover:text-indigo-700 hover:underline">
                ← Quay lại đăng nhập
            </router-link>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const password = ref('')
const confirmPassword = ref('')
const showPassword = ref(false)
const loading = ref(false)
const success = ref('')
const error = ref('')
const passwordError = ref('')
const confirmError = ref('')

function validate() {
    passwordError.value = ''
    confirmError.value = ''

    if (!password.value) {
        passwordError.value = 'Vui lòng nhập mật khẩu mới'
        return false
    }
    if (password.value.length < 6) {
        passwordError.value = 'Mật khẩu phải có ít nhất 6 ký tự'
        return false
    }
    if (password.value !== confirmPassword.value) {
        confirmError.value = 'Mật khẩu xác nhận không khớp'
        return false
    }
    return true
}

async function handleSubmit() {
    if (!validate()) return

    loading.value = true
    error.value = ''
    success.value = ''

    try {
        // TODO: gọi API đặt lại mật khẩu
        // await api.post('/auth/reset-password', { token, password: password.value })
        success.value = 'Mật khẩu đã được đặt lại thành công! Vui lòng đăng nhập.'
    } catch (e) {
        error.value = e?.response?.data?.message || 'Có lỗi xảy ra, vui lòng thử lại.'
    } finally {
        loading.value = false
    }
}
</script>