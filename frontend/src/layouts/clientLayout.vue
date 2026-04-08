<template>
    <div>
        <Navbar />
        <main class="flex-1">
            <RouterView />
        </main>
        <footer class="bg-neutral-primary-soft rounded-base shadow-xs border border-default bottom-0 ">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <router-link to="/" class="flex items-center gap-2 shrink-0">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">&lt;/&gt;</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900">ZestCode</span>
                    </router-link>
                    <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-body sm:mb-0">
                        <li>
                            <a href="#" class="hover:underline me-4 md:me-6">About</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-6 border-default sm:mx-auto lg:my-8" />
                <span class="block text-sm text-body sm:text-center">&copy; {{ new Date().getFullYear() }}
                    ZestCode.DATN_CamTuyen™. All Rights Reserved.</span>
            </div>
        </footer>


    </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';

</script>