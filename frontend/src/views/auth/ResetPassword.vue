<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md space-y-6">

            <div class="text-center">
                <h1 class="text-2xl font-bold">Đặt lại mật khẩu</h1>
            </div>

            <div class="bg-white p-6 rounded-xl shadow space-y-4">

                <div v-if="error" class="bg-red-100 text-red-700 p-3 rounded text-sm">
                    {{ error }}
                </div>

                <input v-model="otp" placeholder="Mã OTP"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" />

                <input v-model="password" type="password" placeholder="Mật khẩu mới"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" />

                <input v-model="confirm" type="password" placeholder="Xác nhận mật khẩu"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" />

                <button @click="handleReset" :disabled="loading"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                    {{ loading ? 'Đang xử lý...' : 'Xác nhận' }}
                </button>

            </div>

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
// import api from '@/api'

const otp = ref('')
const password = ref('')
const confirm = ref('')
const error = ref('')
const loading = ref(false)

const handleReset = async () => {
    error.value = ''

    if (!otp.value || !password.value) {
        error.value = 'Vui lòng nhập đầy đủ'
        return
    }

    if (password.value !== confirm.value) {
        error.value = 'Mật khẩu không khớp'
        return
    }

    loading.value = true

    try {
        // !!! NƠI TÍCH HỢP AXIOS THỰC TẾ !!!
        // await api.post('/auth/reset-password', { otp, password })

        await new Promise(r => setTimeout(r, 1000))

        alert('Đổi mật khẩu thành công')
    } catch {
        error.value = 'Không thể đặt lại mật khẩu'
    } finally {
        loading.value = false
    }
}
</script>