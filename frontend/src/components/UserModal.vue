<script setup>
import { storeToRefs } from "pinia";
import { useUserStore } from "../stores/useUserAdStore";

const userStore = useUserStore();
const { showModal, editingUser, userForm, loading } = storeToRefs(userStore);

const { closeModal, submitUser } = userStore;
window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeModal();
});
</script>
<template>
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center">

        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="closeModal"></div>

        <!-- Modal -->
        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl z-50">

            <form @submit.prevent="submitUser">

                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ editingUser ? "Chỉnh sửa người dùng" : "Thêm người dùng" }}
                    </h3>

                    <button @click="closeModal" type="button" class="text-gray-400 hover:text-gray-600">
                        ✕
                    </button>
                </div>

                <!-- Body -->
                <div class="px-6 py-5 space-y-5">

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Họ và tên
                        </label>
                        <input v-model="userForm.name" type="text" placeholder="Nguyễn Văn A" required class="w-full px-3 py-2 border border-gray-300 rounded-lg
                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input v-model="userForm.email" type="email" placeholder="example@gmail.com" required class="w-full px-3 py-2 border border-gray-300 rounded-lg
                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Số điện thoại
                        </label>
                        <input v-model="userForm.phone" placeholder="090xxxxxxx" class="w-full px-3 py-2 border border-gray-300 rounded-lg
                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Vai trò
                        </label>
                        <select v-model="userForm.role" class="w-full px-3 py-2 border border-gray-300 rounded-lg
                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div v-if="!editingUser">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Mật khẩu
                        </label>
                        <input v-model="userForm.password" type="password" placeholder="••••••••" required class="w-full px-3 py-2 border border-gray-300 rounded-lg
                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    </div>

                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 border-t rounded-b-2xl">

                    <button type="button" @click="closeModal"
                        class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100 transition">
                        Hủy
                    </button>

                    <button type="submit" :disabled="loading"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition flex items-center gap-2 disabled:opacity-50">
                        <svg v-if="loading" class="w-4 h-4 animate-spin" viewBox="0 0 24 24"></svg>
                        {{ loading ? "Đang lưu..." : editingUser ? "Cập nhật" : "Thêm" }}
                    </button>

                </div>

            </form>
        </div>
    </div>
</template>
