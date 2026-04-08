<template>

    <!-- Header -->
    <div class="mb-4">
        <p class="text-sm text-gray-500">Hoàn thành tất cả câu hỏi để nộp bài</p>
    </div>

    <!-- Questions -->
    <div class="space-y-6">
        <div v-for="(q, index) in questions" :key="q.id" class="border rounded-lg p-4">
            <p class="font-medium text-gray-800 mb-3">
                Câu {{ index + 1 }}: {{ q.question }}
            </p>

            <div class="space-y-2">
                <label v-for="opt in q.options" :key="opt.id"
                    class="flex items-center gap-2 p-2 rounded-lg cursor-pointer border hover:bg-gray-50"
                    :class="getOptionClass(q, opt)">
                    <input type="radio" :name="'q-' + q.id" :value="opt.id" v-model="answers[q.id]"
                        :disabled="submitted" />
                    <span>{{ opt.text }}</span>
                </label>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <button @click="submitQuiz" :disabled="submitted"
        class="mt-6 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-all disabled:opacity-50">
        Nộp bài
    </button>

    <!-- Result -->
    <div v-if="submitted" class="mt-6">
        <div class="bg-gray-100 p-4 rounded-lg">
            <p class="font-semibold">Kết quả: {{ score }}%</p>
            <p :class="passed ? 'text-green-600' : 'text-red-600'">
                {{ passed ? 'Đạt yêu cầu' : 'Chưa đạt' }}
            </p>
        </div>
    </div>

</template>

<script setup>
import { ref } from 'vue'

// Mock data (replace bằng props khi dùng thật)
const questions = ref([
    {
        id: 1,
        question: 'Vue 3 sử dụng API nào mới?',
        correct: 2,
        options: [
            { id: 1, text: 'Options API' },
            { id: 2, text: 'Composition API' },
            { id: 3, text: 'Class API' }
        ]
    },
    {
        id: 2,
        question: 'ref dùng để làm gì?',
        correct: 1,
        options: [
            { id: 1, text: 'Tạo reactive value' },
            { id: 2, text: 'Render HTML' },
            { id: 3, text: 'Gọi API' }
        ]
    }
])

const answers = ref({})
const submitted = ref(false)
const score = ref(0)
const passed = ref(false)

const submitQuiz = () => {
    let correctCount = 0

    questions.value.forEach(q => {
        if (answers.value[q.id] === q.correct) {
            correctCount++
        }
    })

    score.value = Math.round((correctCount / questions.value.length) * 100)
    passed.value = score.value >= 70
    submitted.value = true
}

const getOptionClass = (q, opt) => {
    if (!submitted.value) return ''

    if (opt.id === q.correct) {
        return 'border-green-500 bg-green-50'
    }

    if (answers.value[q.id] === opt.id) {
        return 'border-red-500 bg-red-50'
    }

    return ''
}
</script>
