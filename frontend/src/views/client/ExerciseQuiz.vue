<script setup>
import { onMounted, computed } from 'vue'
import { useQuizStore } from '../../stores/useQuizStore'
import { useRoute } from 'vue-router'

const quizStore = useQuizStore()
const route = useRoute()

const isComplete = computed(() => {
    if (!quizStore.quiz) return false
    return quizStore.quiz.questions.every(
        q => quizStore.answers[q.id]
    )
})
const emit = defineEmits(['submitted'])

const submitQuiz = async () => {
    const result = await quizStore.submitQuiz()

    emit('submitted', result) // 🔥 QUAN TRỌNG
}

onMounted(() => {
    quizStore.fetchQuiz(route.params.id)
})
</script>

<template>
    <div v-if="quizStore.quiz">

        <!-- Questions -->
        <div v-for="(q, index) in quizStore.quiz.questions" :key="q.id" class="border p-4 rounded-lg mb-4">

            <p class="font-medium mb-2">
                Câu {{ index + 1 }}: {{ q.content }}
            </p>

            <div v-for="opt in q.answers" :key="opt.id" class="p-2 border rounded cursor-pointer m-2"
                :class="quizStore.answers[q.id] === opt.id ? 'bg-indigo-100' : ''">

                <label class="flex gap-2">
                    <input type="radio" :name="'q-' + q.id" :value="opt.id"
                        :checked="quizStore.answers[q.id] === opt.id" @change="quizStore.setAnswer(q.id, opt.id)" />

                    {{ opt.content }}
                </label>
            </div>
        </div>

        <!-- Submit -->
        <button @click="submitQuiz" :disabled="!isComplete || quizStore.loading"
            class="w-full bg-indigo-600 text-white py-2 rounded-lg">

            {{ quizStore.loading ? 'Đang chấm...' : 'Nộp bài' }}
        </button>

        <!-- Result -->
        <div v-if="quizStore.result" class="mt-4 p-4 bg-gray-100 rounded">

            <p>Điểm: {{ quizStore.result.score }}%</p>

            <p :class="quizStore.result.is_passed ? 'text-green-600' : 'text-red-600'">
                {{ quizStore.result.message }}
            </p>

        </div>

    </div>
</template>