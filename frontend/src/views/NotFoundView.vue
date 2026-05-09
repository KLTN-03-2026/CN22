<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 text-center px-4">
        <div class="space-y-6">

            <h1 class="text-6xl font-bold text-indigo-600">404</h1>

            <h2 class="text-5xl font-semibold text-gray-800 uppercase">
                Trang không tồn tại
            </h2>

            <p class="text-gray-500">
                Có vẻ bạn đã đi lạc mất rồi...
            </p>

            <button @click="$router.push('/')"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                ← Quay về trang chủ
            </button>

        </div>
    </div>
</template>

<script setup>
</script>