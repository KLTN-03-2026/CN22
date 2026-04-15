<template>
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-[700px]">

            <div class="flex items-center gap-4 mb-4">
                <span class="text-lg font-semibold">
                    Chọn chương muốn mua
                </span>
                <button @click="selectAll"
                    class="text-indigo-600 hover:text-indigo-700 text-sm font-medium transition-colors">
                    Chọn tất cả
                </button>
            </div>

            <!-- LIST CHAPTER -->
            <div class="space-y-3 max-h-[500px] overflow-y-auto">

                <div v-for="chapter in chapters" :key="chapter.id"
                    class="flex items-center justify-between p-3 border rounded-lg"
                    :class="selected.includes(chapter.id) ? 'bg-indigo-50 border-indigo-400' : ''">

                    <div class="flex items-center gap-3">

                        <input type="checkbox" :value="chapter.id" v-model="selected"
                            :disabled="chapter.is_free || chapter.is_accessible" />

                        <div>
                            <p class="font-medium">{{ chapter.title }}</p>
                            <p class="text-xs text-gray-500">
                                {{ chapter.is_free ? 'Miễn phí' : formatCurrency(chapter.price) }}
                            </p>
                        </div>

                    </div>

                    <span v-if="chapter.is_accessible" class="text-green-600 text-sm">
                        ✔ Đã mở
                    </span>

                </div>

            </div>

            <!-- TOTAL -->
            <div class="mt-4 border-t pt-4">

                <p class="text-sm text-gray-500">Tổng tiền</p>

                <p class="text-xl font-bold text-indigo-600">
                    {{ formatCurrency(total) }}
                </p>

            </div>

            <!-- ACTION -->
            <div class="mt-5 flex gap-2">

                <button @click="$emit('close')" class="flex-1 border py-2 rounded-lg">
                    Hủy
                </button>

                <button @click="submit" :disabled="selected.length === 0"
                    class="flex-1 bg-indigo-600 text-white py-2 rounded-lg disabled:opacity-50">
                    Thanh toán
                </button>

            </div>

        </div>

    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    chapters: Array
})

const emit = defineEmits(['close', 'submit'])

const selected = ref([])

const selectAll = () => {
    selected.value = props.chapters
        .filter(c => !c.is_free && !c.is_accessible)
        .map(c => c.id)
}
const total = computed(() => {
    return props.chapters
        .filter(c => selected.value.includes(c.id))
        .reduce((sum, c) => sum + Number(c.price), 0)
})

const submit = () => {
    emit('submit', selected.value)
}

const formatCurrency = (p) =>
    new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(p || 0)
</script>