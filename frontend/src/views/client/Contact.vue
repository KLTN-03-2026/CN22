<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section
            class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500 py-20 px-4 md:py-32">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative mx-auto max-w-6xl text-center">
                <h1 class="mb-6 text-4xl font-bold text-white md:text-5xl lg:text-6xl">
                    Liên hệ với chúng tôi
                </h1>
                <p class="mx-auto mb-8 max-w-2xl text-lg text-white/90 md:text-xl">
                    Chúng tôi luôn sẵn sàng hỗ trợ bạn trên hành trình học lập trình
                </p>
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

        <!-- Contact Info & Form Section -->
        <section class="py-16 px-4 md:py-20">
            <div class="mx-auto max-w-6xl">
                <div class="grid gap-12 md:grid-cols-2">
                    <!-- Contact Info Section -->
                    <div class="space-y-8">
                        <h2 class="text-2xl font-bold text-gray-900 md:text-3xl">
                            Thông tin liên hệ
                        </h2>
                        <p class="text-lg text-gray-600">
                            Hãy liên hệ với chúng tôi qua bất kỳ kênh nào dưới đây. Đội ngũ hỗ trợ của ZestCode luôn sẵn
                            sàng giải đáp mọi thắc mắc của bạn.
                        </p>

                        <div class="space-y-6">
                            <!-- Email Contact -->
                            <div class="flex items-start space-x-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                                    <p class="text-gray-600">support@zestcode.dev</p>
                                    <p class="text-sm text-gray-500">Chúng tôi sẽ phản hồi trong vòng 24 giờ</p>
                                </div>
                            </div>

                            <!-- Phone Contact -->
                            <div class="flex items-start space-x-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-green-600">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Điện thoại</h3>
                                    <p class="text-gray-600">0123 456 789</p>
                                    <p class="text-sm text-gray-500">Thứ Hai - Thứ Sáu, 9:00 - 18:00</p>
                                </div>
                            </div>

                            <!-- Location Contact -->
                            <div class="flex items-start space-x-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Địa chỉ</h3>
                                    <p class="text-gray-600">Da Nang, Vietnam</p>
                                    <p class="text-sm text-gray-500">Văn phòng chính tại trung tâm thành phố</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Quick Section -->
                        <div class="mt-12 rounded-xl bg-gray-100 p-6">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900">Câu hỏi thường gặp</h3>
                            <div class="space-y-3">
                                <details class="group">
                                    <summary
                                        class="flex cursor-pointer justify-between text-gray-700 hover:text-gray-900">
                                        <span>Bao lâu nhận được phản hồi?</span>
                                        <svg class="h-5 w-5 text-gray-500 group-open:rotate-180 transition-transform"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>
                                    <p class="mt-2 text-gray-600">Chúng tôi cam kết phản hồi email trong vòng 24 giờ làm
                                        việc. Đối với các vấn đề khẩn cấp, vui lòng gọi trực tiếp vào số điện thoại của
                                        chúng tôi.</p>
                                </details>
                                <details class="group">
                                    <summary
                                        class="flex cursor-pointer justify-between text-gray-700 hover:text-gray-900">
                                        <span>Có hỗ trợ kỹ thuật không?</span>
                                        <svg class="h-5 w-5 text-gray-500 group-open:rotate-180 transition-transform"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>
                                    <p class="mt-2 text-gray-600">Có, chúng tôi có đội ngũ hỗ trợ kỹ thuật chuyên trách
                                        sẵn sàng giải quyết các vấn đề liên quan đến nền tảng học tập và các bài tập lập
                                        trình.</p>
                                </details>
                                <details class="group">
                                    <summary
                                        class="flex cursor-pointer justify-between text-gray-700 hover:text-gray-900">
                                        <span>Làm thế nào để bắt đầu?</span>
                                        <svg class="h-5 w-5 text-gray-500 group-open:rotate-180 transition-transform"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>
                                    <p class="mt-2 text-gray-600">Chỉ cần đăng ký tài khoản miễn phí trên ZestCode, bạn
                                        có thể bắt đầu ngay với các khóa học cơ bản và tiến trình học sẽ được cá nhân
                                        hóa theo trình độ của bạn.</p>
                                </details>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form Section -->
                    <div class="rounded-2xl bg-white p-8 shadow-lg">
                        <h2 class="mb-6 text-2xl font-bold text-gray-900 md:text-3xl">
                            Gửi tin nhắn cho chúng tôi
                        </h2>

                        <form @submit.prevent="handleSubmit" class="space-y-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input id="name" v-model="form.name" type="text" :class="[
                                        'block w-full pl-10 pr-3 py-3 border rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out',
                                        errors.name ? 'border-red-500' : 'border-gray-300'
                                    ]" placeholder="Nhập họ và tên của bạn">
                                </div>
                                <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name }}</p>
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input id="email" v-model="form.email" type="email" :class="[
                                        'block w-full pl-10 pr-3 py-3 border rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out',
                                        errors.email ? 'border-red-500' : 'border-gray-300'
                                    ]" placeholder="email@example.com">
                                </div>
                                <p v-if="errors.email" class="mt-2 text-sm text-red-600">{{ errors.email }}</p>
                            </div>

                            <!-- Message Field -->
                            <div>
                                <label for="message" class="mb-2 block text-sm font-medium text-gray-700">
                                    Tin nhắn <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <textarea id="message" v-model="form.message" rows="4" :class="[
                                        'block w-full pl-10 pr-3 py-3 border rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out',
                                        errors.message ? 'border-red-500' : 'border-gray-300'
                                    ]" placeholder="Nhập nội dung tin nhắn của bạn..."></textarea>
                                </div>
                                <p v-if="errors.message" class="mt-2 text-sm text-red-600">{{ errors.message }}</p>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" :disabled="isSubmitting"
                                    class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg v-if="isSubmitting" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    {{ isSubmitting ? 'Đang gửi...' : 'Gửi liên hệ' }}
                                </button>
                            </div>
                        </form>

                        <!-- Success/Error Messages -->
                        <div v-if="submitMessage" class="mt-6 rounded-lg p-4"
                            :class="submitSuccess ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'">
                            <div class="flex">
                                <div class="">
                                    <svg v-if="submitSuccess" class="h-5 w-5 text-green-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">
                                        {{ submitSuccess ? 'Gửi thành công!' : 'Có lỗi xảy ra!' }}
                                    </p>
                                    <p class="mt-1 text-sm">
                                        {{ submitMessage }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call To Action -->
        <section class="bg-gradient-to-r from-indigo-600 to-cyan-500 py-16 px-4 md:py-20">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl">
                    Tham gia ZestCode ngay hôm nay
                </h2>
                <p class="mb-8 text-lg text-white/90">
                    Bắt đầu hành trình học lập trình thông minh và hiệu quả
                </p>
                <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
                    <router-link to="/signup">
                        <button
                            class="rounded-lg bg-white px-8 py-3 font-semibold text-blue-600 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                            Đăng ký miễn phí
                        </button>
                    </router-link>
                    <router-link to="/courses">
                        <button
                            class="rounded-lg border-2 border-white px-8 py-3 font-semibold text-white transition-all duration-300 hover:bg-white hover:text-blue-600">
                            Xem khóa học
                        </button>
                    </router-link>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';

// Form state
const form = reactive({
    name: '',
    email: '',
    message: ''
});

// Form errors
const errors = reactive({
    name: '',
    email: '',
    message: ''
});

// Submit state
const isSubmitting = ref(false);
const submitMessage = ref('');
const submitSuccess = ref(false);

// Validate email format
const validateEmail = (email) => {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
};

// Validate form
const validateForm = () => {
    // Reset errors
    errors.name = '';
    errors.email = '';
    errors.message = '';

    let isValid = true;

    // Validate name
    if (!form.name.trim()) {
        errors.name = 'Vui lòng nhập họ và tên';
        isValid = false;
    }

    // Validate email
    if (!form.email.trim()) {
        errors.email = 'Vui lòng nhập email';
        isValid = false;
    } else if (!validateEmail(form.email)) {
        errors.email = 'Email không hợp lệ';
        isValid = false;
    }

    // Validate message
    if (!form.message.trim()) {
        errors.message = 'Vui lòng nhập nội dung tin nhắn';
        isValid = false;
    }

    return isValid;
};

// Handle form submission
const handleSubmit = async () => {
    if (!validateForm()) return;

    isSubmitting.value = true;
    submitMessage.value = '';

    try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1500));

        // Reset form
        form.name = '';
        form.email = '';
        form.message = '';

        // Show success message
        submitSuccess.value = true;
        submitMessage.value = 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi trong vòng 24 giờ.';
    } catch (error) {
        // Show error message
        submitSuccess.value = false;
        submitMessage.value = 'Đã có lỗi xảy ra. Vui lòng thử lại sau.';
    } finally {
        isSubmitting.value = false;

        // Clear message after 5 seconds
        setTimeout(() => {
            submitMessage.value = '';
        }, 5000);
    }
};

// Simple fade-in animation on scroll
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