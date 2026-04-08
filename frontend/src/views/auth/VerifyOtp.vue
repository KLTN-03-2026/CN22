<template>
    <div class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-lg">
            <!-- Header -->
            <div class="text-center">
                <a href="/" class="inline-flex items-center space-x-2 text-2xl font-bold text-blue-600">
                    <i class="fas fa-code"></i>
                    <span>ZestCode</span>
                </a>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Xác thực tài khoản</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Chúng tôi đã gửi một mã gồm 6 số đến email của bạn.
                </p>
                <p class="text-sm font-medium text-gray-900 mt-1">
                    {{ userEmail }}
                </p>
            </div>

            <!-- Form OTP -->
            <form @submit.prevent="handleVerify" class="mt-8 space-y-6">
                <!-- Hiển thị thông báo lỗi chung -->
                <div v-if="errorMessage" class="p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">Lỗi!</span> {{ errorMessage }}
                </div>

                <!-- Hiển thị thông báo thành công -->
                <div v-if="successMessage" class="p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <span class="font-medium">Thành công!</span> {{ successMessage }}
                </div>

                <!-- Nhóm ô nhập OTP -->
                <div class="flex justify-center space-x-3">
                    <input v-for="(digit, index) in otpDigits" :key="index" v-model="otpDigits[index]" type="text"
                        maxlength="1" class="otp-input" @input="handleInput($event, index)"
                        @keydown="handleKeyDown($event, index)" @paste="handlePaste" />
                </div>

                <!-- Nút xác thực -->
                <div>
                    <button type="submit" :disabled="!isOtpComplete || isVerifying"
                        class="relative w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg group hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors">
                        <span v-if="!isVerifying" class="flex items-center justify-center">
                            <i class="fas fa-lock mr-2"></i>
                            Xác thực
                        </span>
                        <span v-else class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Đang xác thực...
                        </span>
                    </button>
                </div>

                <!-- Đếm ngược và gửi lại -->
                <div class="text-center">
                    <p v-if="timeLeft > 0" class="text-sm text-gray-600">
                        Mã sẽ hết hạn sau <span class="font-bold text-blue-600">{{ formattedTime }}</span>
                    </p>
                    <button type="button" @click="handleResend" :disabled="timeLeft > 0 || isResending"
                        class="mt-2 text-sm font-medium text-blue-600 hover:text-blue-500 disabled:text-gray-400 disabled:cursor-not-allowed transition-colors">
                        <span v-if="!isResending">Gửi lại mã</span>
                        <span v-else>Đang gửi...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import axios from '../../router/api.js';
import { inject } from 'vue'
import { useRouter } from 'vue-router';


const props = defineProps<{
    userEmail: string
}>();

const router = useRouter();
const toaster = inject('toast') as any
// --- EMITS ---
const emit = defineEmits<{
    (e: 'verified', data: any): void
}>();

const otpDigits = ref(['', '', '', '', '', '']);
const errorMessage = ref('');
const successMessage = ref('');
const isVerifying = ref(false);
const isResending = ref(false);
const timeLeft = ref(120);
let timerInterval: any = null;

const isOtpComplete = computed(() => otpDigits.value.every(digit => digit !== ''));
const otpCode = computed(() => otpDigits.value.join(''));
const formattedTime = computed(() => {
    const minutes = Math.floor(timeLeft.value / 60);
    const seconds = timeLeft.value % 60;
    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
});


const handleInput = (event: Event, index: number) => {
    const input = event.target as HTMLInputElement;
    let val = input.value.replace(/[^0-9]/g, '');

    // Nếu paste nhiều số vào 1 ô
    if (val.length > 1) {
        val = val[0];
    }

    otpDigits.value[index] = val;

    if (val && index < 5) {
        const next = input.nextElementSibling as HTMLInputElement;
        next?.focus();
    }
};

const handleKeyDown = (event: KeyboardEvent, index: number) => {
    if (event.key === 'Backspace' && !otpDigits.value[index] && index > 0) {
        const input = event.target as HTMLInputElement;
        const prev = input.previousElementSibling as HTMLInputElement;
        prev?.focus();
    }
};

const handlePaste = (event: ClipboardEvent) => {
    event.preventDefault();
    const pastedData = event.clipboardData.getData('text').slice(0, 6).replace(/[^0-9]/g, '') || '';
    pastedData.split('').forEach((char, i) => {
        if (i < 6) otpDigits.value[i] = char;
    });
};

const startTimer = () => {
    if (timerInterval) clearInterval(timerInterval);
    timeLeft.value = 120;
    timerInterval = setInterval(() => {
        if (timeLeft.value > 0) timeLeft.value--;
        else clearInterval(timerInterval);
    }, 1000);
};

// Tự động gọi handleVerify khi nhập đủ 6 số
watch(otpCode, (newVal) => {
    if (newVal.length === 6 && !isVerifying.value) {
        handleVerify();
    }
});

const handleVerify = async () => {
    if (!isOtpComplete.value || isVerifying.value) return;

    isVerifying.value = true;
    errorMessage.value = '';

    try {
        const response = await axios.post('/auth/verify-otp', {
            email: props.userEmail,
            code: otpCode.value
        });

        toaster.success(response.data.message || 'Xác thực thành công!');
        router.push('/');
        emit('verified', response.data);
    } catch (err: any) {
        const res = err.response

        if (res?.status === 422 && res.data?.errors) {
            const error = res.data.errors

            Object.keys(error).forEach((key) => {
                error[key] = error[key]?.[0] || ''
            })

            otpDigits.value = ['', '', '', '', '', ''];

        } else {
            toaster.error(res?.data?.message || 'Đã xảy ra lỗi, vui lòng thử lại');
        }
    } finally {
        isVerifying.value = false;
    }
};

const handleResend = async () => {
    if (timeLeft.value > 0 || isResending.value) return;
    // ... logic axios của bạn giữ nguyên
    startTimer();
};

onMounted(() => {
    startTimer();
});

onUnmounted(() => {
    if (timerInterval) clearInterval(timerInterval);
});
</script>


<style scoped>
/* Tùy chỉnh cho ô input OTP */
.otp-input {
    width: 3.5rem;
    height: 3.5rem;
    text-align: center;
    font-size: 1.875rem;
    font-weight: bold;
    border: 2px solid #e5e7eb;
    border-radius: 0.5rem;
    transition: all 0.2s ease-in-out;
    /* Loại bỏ mũi tên tăng/giảm trên trình duyệt */
    -moz-appearance: textfield;
}

.otp-input::-webkit-outer-spin-button,
.otp-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.otp-input:focus {
    border-color: #3b82f6;
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>