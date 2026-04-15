<template>
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-[400px] text-center">

            <h2 class="text-lg font-semibold mb-4">Thanh toán</h2>

            <!-- QR -->
            <!-- QR -->
            <img v-if="qr" :src="qr" class="w-52 mx-auto mb-4 border rounded-lg" />

            <p v-else class="text-gray-400 mb-4">Đang tạo QR...</p>

            <p class="text-gray-600 mb-2">Quét QR để thanh toán</p>

            <!-- Status -->
            <p class="text-sm" :class="status === 1 ? 'text-green-600' : 'text-gray-500'">
                {{ status === 1 ? '✅ Đã thanh toán' : '⏳ Đang chờ thanh toán...' }}
            </p>

            <!-- Actions -->
            <div class="mt-5 flex gap-2">
                <button @click="$emit('close')" class="flex-1 border py-2 rounded-lg">
                    Đóng
                </button>
            </div>

        </div>
    </div>
</template>
<script setup>
import { onMounted, onUnmounted } from 'vue'
import { usePaymentStore } from '../../stores/usePaymentStore'
import { storeToRefs } from 'pinia'

const props = defineProps({
    orderId: Number
})

const emit = defineEmits(['close', 'paid'])

const paymentStore = usePaymentStore()

const { qr, status } = storeToRefs(paymentStore)

let interval = null

const check = async () => {
    await paymentStore.checkStatus(props.orderId)

    if (status.value === 1) {
        clearInterval(interval)
        emit('paid')
    }
    // tránh delay UX
    await check() 
}

onMounted(() => {
    interval = setInterval(check, 3000)
})

onUnmounted(() => {
    clearInterval(interval)
})
</script>