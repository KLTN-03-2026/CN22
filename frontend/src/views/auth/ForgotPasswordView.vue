<template>
    <div class="w-full max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Quên mật khẩu</h1>
            <p class="text-gray-500 mt-2">Nhập email đã đăng ký để nhận mã xác nhận</p>
        </div>

        <div class="rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 p-8">
            <div v-if="success" class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6">
                {{ success }}
            </div>

            <div v-if="error" class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6">
                {{ error }}
            </div>

            <form @submit.prevent="handleSubmit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input v-model="email" type="email" placeholder="you@example.com"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all" />
                </div>

                <button :disabled="loading"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white py-3 rounded-xl font-semibold transition-all">
                    {{ loading ? 'Đang gửi...' : 'Gửi mã xác nhận' }}
                </button>
            </form>

            <div class="text-center mt-6">
                <router-link to="/auth/login" class="text-sm text-indigo-600 hover:text-indigo-700 hover:underline">
                    <i class="fa-solid fa-arrow-left pe-5"></i> Quay lại đăng nhập
                </router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
</script>