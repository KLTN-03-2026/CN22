<!-- src/layouts/ClientLayout.vue -->
<template>

    <div class="min-h-screen flex flex-col">
        <Navbar />
        <!-- Main Content -->
        <main class="flex-1">
            <router-view></router-view>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-neutral-200 py-8 mt-auto">
            <div class="max-w-7xl mx-auto px-6 text-center text-sm text-neutral-500">
                © 2026 ZestCode. Nền tảng học lập trình hiện đại.
            </div>
        </footer>
    </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';

// ClientLayout - Layout cho học viên
</script>