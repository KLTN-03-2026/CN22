<template>
    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section
            class="relative overflow-hidden bg-linear-to-br from-indigo-600 via-blue-600 to-cyan-500 py-20 px-4 md:py-32">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative mx-auto max-w-6xl text-center">
                <h1 class="mb-6 text-4xl font-bold text-white md:text-5xl lg:text-6xl">
                    Về ZestCode
                </h1>
                <p class="mx-auto mb-8 max-w-2xl text-lg text-white/90 md:text-xl">
                    Nền tảng học lập trình cá nhân hóa bằng AI
                </p>
                <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
                    <button
                        class="rounded-lg bg-white px-8 py-3 font-semibold text-blue-600 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        Bắt đầu học
                    </button>
                    <button
                        class="rounded-lg border-2 border-white px-8 py-3 font-semibold text-white transition-all duration-300 hover:bg-white hover:text-blue-600">
                        Tìm hiểu thêm
                    </button>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute -bottom-1 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                        fill="white" />
                </svg>
            </div>
        </section>

        <!-- Intro Section -->
        <section class="py-16 px-4 md:py-20">
            <div class="mx-auto max-w-6xl">
                <div class="grid items-center gap-12 md:grid-cols-2">
                    <div class="space-y-6">
                        <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">
                            Học lập trình thông minh hơn
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            ZestCode là nền tảng học lập trình ứng dụng AI nhằm cá nhân hóa quá trình học tập, giúp
                            người học không chỉ giải bài mà còn hiểu sâu bản chất và cải thiện tư duy thuật toán.
                        </p>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Khác với các nền tảng truyền thống chỉ tập trung vào việc giải quyết bài toán, chúng tôi tập
                            trung vào việc phát triển tư duy lập trình thông qua phản hồi thông minh và lộ trình học tập
                            được điều chỉnh liên tục dựa trên tiến độ của từng cá nhân.
                        </p>
                        <div class="pt-4">
                            <a href="#" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-700">
                                Tìm hiểu về công nghệ của chúng tôi
                                <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <div
                            class="aspect-w-16 aspect-h-9 rounded-2xl bg-linear-to-br from-blue-50 to-indigo-100 p-8 shadow-lg">
                            <div class="flex h-full items-center justify-center">
                                <div class="text-center">
                                    <div
                                        class="mx-auto mb-4 h-24 w-24 rounded-full bg-linear-to-br from-blue-500 to-indigo-600 p-1">
                                        <div
                                            class="flex h-full w-full items-center justify-center rounded-full bg-white">
                                            <svg class="h-12 w-12 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900">AI-Powered Learning</h3>
                                    <p class="mt-2 text-gray-600">Công nghệ AI đột phá giúp cá nhân hóa lộ trình học</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Features Section -->
        <section class="bg-gray-50 py-16 px-4 md:py-20">
            <div class="mx-auto max-w-6xl">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">
                        Điểm khác biệt công nghệ
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Những tính năng độc đáo giúp ZestCode vượt trội so với các nền tảng học lập trình truyền thống
                    </p>
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Feature 1 -->
                    <div class="group rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-lg">
                        <div
                            class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-linear-to-br from-blue-500 to-indigo-600 text-white">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3
                            class="mb-4 text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                            Sinh câu hỏi bằng AI
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            Khác với các hệ thống sử dụng ngân hàng câu hỏi cố định, ZestCode ứng dụng Gemini AI để tạo
                            ra các biến thể câu hỏi trắc nghiệm dựa trên bộ dữ liệu gốc. Điều này đảm bảo tính khách
                            quan, tránh học vẹt và duy trì độ khó tương đương.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-lg">
                        <div
                            class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-linear-to-br from-cyan-500 to-teal-600 text-white">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3
                            class="mb-4 text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                            Phân tích mã nguồn thông minh
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            Hệ thống không chỉ kiểm tra đầu ra mà còn sử dụng AI để đánh giá cấu trúc mã nguồn, độ phức
                            tạp thuật toán và đề xuất tối ưu hóa. Người học nhận được phản hồi chi tiết về cách cải
                            thiện code của mình.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-lg">
                        <div
                            class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-linear-to-br from-purple-500 to-pink-600 text-white">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3
                            class="mb-4 text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                            Hệ thống phản hồi đa tầng
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            Tích hợp Hints theo 3 cấp độ giúp người học tự tìm lời giải thay vì cung cấp đáp án trực
                            tiếp. Mỗi gợi ý được cá nhân hóa dựa trên lỗi cụ thể mà người học đang gặp phải.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="group rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-lg">
                        <div
                            class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-linear-to-br from-amber-500 to-orange-600 text-white">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3
                            class="mb-4 text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                            Lộ trình học thích ứng
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            Sau mỗi bài thi, hệ thống phân tích điểm yếu và đề xuất nội dung bổ trợ, tạo vòng lặp cải
                            thiện liên tục. Lộ trình học tự động điều chỉnh dựa trên tiến độ và mục tiêu của từng người
                            học.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-16 px-4 md:py-20">
            <div class="mx-auto max-w-6xl">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">
                        Cách ZestCode hoạt động
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Quy trình học tập thông minh được thiết kế để tối ưu hóa việc tiếp thu kiến thức
                    </p>
                </div>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-8 top-0 h-full w-0.5 bg-gray-200 md:left-1/2 md:-translate-x-0.5"></div>

                    <div class="space-y-12">
                        <!-- Step 1 -->
                        <div class="relative flex items-center md:justify-between">
                            <div class="md:w-5/12 md:pr-8 md:text-right">
                                <h3 class="text-xl font-semibold text-gray-900">Học lý thuyết</h3>
                                <p class="mt-2 text-gray-600">
                                    Tiếp cận kiến thức qua các bài giảng tương tác, được trình bày một cách trực quan và
                                    dễ hiểu.
                                </p>
                            </div>
                            <div
                                class="absolute left-8 flex h-16 w-16 -translate-x-1/2 items-center justify-center rounded-full bg-blue-600 text-white md:relative md:left-1/2 md:-translate-x-1/2">
                                <span class="text-xl font-bold">1</span>
                            </div>
                            <div class="hidden md:block md:w-5/12 md:pl-8"></div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative flex items-center md:justify-between">
                            <div class="hidden md:block md:w-5/12 md:pr-8"></div>
                            <div
                                class="absolute left-8 flex h-16 w-16 -translate-x-1/2 items-center justify-center rounded-full bg-blue-600 text-white md:relative md:left-1/2 md:-translate-x-1/2">
                                <span class="text-xl font-bold">2</span>
                            </div>
                            <div class="md:w-5/12 md:pl-8">
                                <h3 class="text-xl font-semibold text-gray-900">Làm bài tập</h3>
                                <p class="mt-2 text-gray-600">
                                    Áp dụng kiến thức đã học vào các bài tập thực tế được cá nhân hóa dựa trên trình độ
                                    của bạn.
                                </p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative flex items-center md:justify-between">
                            <div class="md:w-5/12 md:pr-8 md:text-right">
                                <h3 class="text-xl font-semibold text-gray-900">Nhận feedback từ AI</h3>
                                <p class="mt-2 text-gray-600">
                                    Nhận phản hồi chi tiết và tức thì về cách giải quyết, cùng các gợi ý để cải thiện kỹ
                                    năng lập trình.
                                </p>
                            </div>
                            <div
                                class="absolute left-8 flex h-16 w-16 -translate-x-1/2 items-center justify-center rounded-full bg-blue-600 text-white md:relative md:left-1/2 md:-translate-x-1/2">
                                <span class="text-xl font-bold">3</span>
                            </div>
                            <div class="hidden md:block md:w-5/12 md:pl-8"></div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative flex items-center md:justify-between">
                            <div class="hidden md:block md:w-5/12 md:pr-8"></div>
                            <div
                                class="absolute left-8 flex h-16 w-16 -translate-x-1/2 items-center justify-center rounded-full bg-blue-600 text-white md:relative md:left-1/2 md:-translate-x-1/2">
                                <span class="text-xl font-bold">4</span>
                            </div>
                            <div class="md:w-5/12 md:pl-8">
                                <h3 class="text-xl font-semibold text-gray-900">Cải thiện và lặp lại</h3>
                                <p class="mt-2 text-gray-600">
                                    Hệ thống phân tích điểm yếu và đề xuất các bài tập bổ trợ, tạo vòng lặp cải thiện
                                    liên tục.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision / Mission Section -->
        <section class="bg-gray-50 py-16 px-4 md:py-20">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="mb-12 text-3xl font-bold text-gray-900 md:text-4xl">
                    Tầm nhìn & Sứ mệnh
                </h2>

                <div class="grid gap-8 md:grid-cols-2">
                    <div class="rounded-xl bg-white p-8 shadow-sm">
                        <div
                            class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-linear-to-br from-blue-500 to-indigo-600 text-white mx-auto">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Tầm nhìn</h3>
                        <p class="text-gray-600">
                            "Trở thành nền tảng học lập trình cá nhân hóa hàng đầu, giúp hàng triệu người trên thế giới
                            phát triển tư duy lập trình và kỹ năng giải quyết vấn đề."
                        </p>
                    </div>

                    <div class="rounded-xl bg-white p-8 shadow-sm">
                        <div
                            class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-linear-to-br from-cyan-500 to-teal-600 text-white mx-auto">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Sứ mệnh</h3>
                        <p class="text-gray-600">
                            "Giúp người học hiểu sâu và phát triển tư duy thay vì học vẹt, tạo ra thế hệ lập trình viên
                            sáng tạo và có khả năng giải quyết các vấn đề phức tạp."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call To Action -->
        <section class="bg-linear-to-r from-indigo-600 to-cyan-500 py-16 px-4 md:py-20">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl">
                    Bắt đầu hành trình học lập trình thông minh ngay hôm nay
                </h2>
                <p class="mb-8 text-lg text-white/90">
                    Tham gia cộng đồng hàng ngàn lập trình viên đang nâng cao kỹ năng với ZestCode
                </p>
                <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
                    <button
                        class="rounded-lg bg-white px-8 py-3 font-semibold text-blue-600 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        Tham gia ZestCode
                    </button>
                    <button
                        class="rounded-lg border-2 border-white px-8 py-3 font-semibold text-white transition-all duration-300 hover:bg-white hover:text-blue-600">
                        Liên hệ tư vấn
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, { threshold: 0.1 });

    // Observe all sections
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });
});
</script>

<style scoped>
.fade-in {
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>