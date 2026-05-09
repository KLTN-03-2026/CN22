<script setup>
import { ref, computed } from 'vue'
import CodePracticeSection from '../components/CodePracticeSection.vue'
const initialCode = `// Viết hàm tính tổng hai số
function add(a, b) {
  return a + b
}

// Test hàm
console.log(add(2, 3))`

const codeHint = 'Sử dụng return a + b để trả về kết quả'

const codeTestCases = [
  {
    description: 'add(2, 3) phải trả về 5',
    passed: false,
    run: false
  },
  {
    description: 'add(-1, 10) phải trả về 9',
    passed: false,
    run: false
  }
]
// State
const currentQuestionIndex = ref(0)
const userAnswers = ref({})
const showResults = ref(false)

// Navigation state
const prevLessonId = 'lesson-1'
const nextLessonId = 'lesson-3'

// Hardcoded lesson data
const lesson = {
    title: 'Vue.js từ A đến Z - Bài 1: Giới thiệu',
    slug: 'vue-js-bai-1-gioi-thieu',
    content: `
    <h2>Chào mừng đến với khóa học Vue.js từ A đến Z!</h2>
    <p>Trong bài học này, chúng ta sẽ tìm hiểu:</p>
    <ul>
      <li>Vue.js là gì?</li>
      <li>Lịch sử phát triển của Vue.js</li>
      <li>Tại sao nên học Vue.js?</li>
      <li>Các khái niệm cơ bản</li>
    </ul>
    <p>Vue.js là một framework JavaScript progressive, cho phép bạn xây dựng giao diện người dùng một cách dễ dàng.</p>
  `,
    videoUrl: null, // Không có video cho demo
    duration: '15:30',
    order: 1,
    section: {
        id: 1,
        title: 'Phần 1: Giới thiệu',
        lessons: [
            {
                id: 'lesson-1',
                slug: 'vue-js-bai-1-gioi-thieu',
                title: 'Vue.js là gì?',
                duration: '15:30',
                order: 1
            },
            {
                id: 'lesson-2',
                slug: 'vue-js-bai-2-cai-dat',
                title: 'Cài đặt môi trường',
                duration: '20:45',
                order: 2
            },
            {
                id: 'lesson-3',
                slug: 'vue-js-bai-3-hello-vue',
                title: 'Hello Vue',
                duration: '25:10',
                order: 3
            }
        ]
    },
    quiz: {
        questions: [
            {
                id: 1,
                question: 'Vue.js là framework gì?',
                answers: [
                    { id: 1, text: 'JavaScript framework', isCorrect: true },
                    { id: 2, text: 'CSS framework', isCorrect: false },
                    { id: 3, text: 'PHP framework', isCorrect: false },
                    { id: 4, text: 'Python framework', isCorrect: false }
                ]
            },
            {
                id: 2,
                question: 'Cách cài đặt Vue.js là gì?',
                answers: [
                    { id: 1, text: 'npm install vue', isCorrect: true },
                    { id: 2, text: 'pip install vue', isCorrect: false },
                    { id: 3, text: 'composer require vue', isCorrect: false },
                    { id: 4, text: 'gem install vue', isCorrect: false }
                ]
            },
            {
                id: 3,
                question: 'Directive v-for dùng để làm gì?',
                answers: [
                    { id: 1, text: 'Lặp qua mảng', isCorrect: true },
                    { id: 2, text: 'Điều kiện hiển thị', isCorrect: false },
                    { id: 3, text: 'Xử lý sự kiện', isCorrect: false },
                    { id: 4, text: 'Binding thuộc tính', isCorrect: false }
                ]
            }
        ]
    }
}

// Methods
const handleAnswerSelect = (questionId, answerId) => {
    userAnswers.value[questionId] = answerId
}

const isAllAnswered = computed(() => {
    return lesson.quiz.questions.every(q => userAnswers.value[q.id])
})

const submitQuiz = () => {
    showResults.value = true
    // TODO: Call API to submit quiz
}

const goToPrevLesson = () => {
    // Navigate to previous lesson
    console.log('Navigate to:', prevLessonId)
}

const goToNextLesson = () => {
    // Navigate to next lesson
    console.log('Navigate to:', nextLessonId)
}

const resetQuiz = () => {
    showResults.value = false
    currentQuestionIndex.value = 0
    userAnswers.value = {}
}

const calculateCorrectAnswers = () => {
    return lesson.quiz.questions.filter(q => {
        const selectedAnswer = q.answers.find(a => a.id === userAnswers.value[q.id])
        return selectedAnswer?.isCorrect
    }).length
}

const isAnswerCorrect = (questionId) => {
    const question = lesson.quiz.questions.find(q => q.id === questionId)
    if (!question) return false
    const selectedAnswer = question.answers.find(a => a.id === userAnswers.value[questionId])
    return selectedAnswer?.isCorrect
}
</script>

<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span class="sr-only">Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-700">Khóa học</a>
                </li>
                <li>
                    <span class="text-gray-500" aria-current="page">Bài học</span>
                </li>
            </ol>
        </nav>

        <!-- Video Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="aspect-video bg-gray-100 flex items-center justify-center">
                <div class="text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <p class="mt-2 text-gray-500">Không có video cho bài học này</p>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ lesson.title }}</h2>
            <div class="prose max-w-none" v-html="lesson.content"></div>
        </div>

        <!-- Quiz Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Bài kiểm tra</h2>

            <!-- Quiz Navigation -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                        Câu {{ currentQuestionIndex + 1 }}/{{ lesson.quiz.questions.length }}
                    </span>
                    <button v-if="showResults" @click="resetQuiz" class="text-sm text-indigo-600 hover:text-indigo-800">
                        Làm lại
                    </button>
                </div>

                <!-- Progress Bar -->
                <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full transition-all duration-300"
                        :style="{ width: `${((currentQuestionIndex + 1) / lesson.quiz.questions.length) * 100}%` }">
                    </div>
                </div>
            </div>

            <!-- Question Slide -->
            <div v-if="!showResults" class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ lesson.quiz.questions[currentQuestionIndex].question }}
                    </h3>

                    <div class="space-y-3">
                        <label v-for="answer in lesson.quiz.questions[currentQuestionIndex].answers" :key="answer.id"
                            class="flex items-center p-4 bg-white rounded-lg border cursor-pointer hover:border-indigo-300 transition-colors"
                            :class="{
                                'border-indigo-500 bg-indigo-50': userAnswers[lesson.quiz.questions[currentQuestionIndex].id] === answer.id
                            }">
                            <input type="radio" :name="`question-${lesson.quiz.questions[currentQuestionIndex].id}`"
                                :value="answer.id"
                                :checked="userAnswers[lesson.quiz.questions[currentQuestionIndex].id] === answer.id"
                                @change="handleAnswerSelect(lesson.quiz.questions[currentQuestionIndex].id, answer.id)"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" />
                            <span class="ml-3 text-gray-700">{{ answer.text }}</span>
                        </label>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between">
                    <button @click="currentQuestionIndex--" :disabled="currentQuestionIndex === 0"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        Câu trước
                    </button>

                    <button @click="currentQuestionIndex++"
                        :disabled="currentQuestionIndex === lesson.quiz.questions.length - 1"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        Câu sau
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button @click="submitQuiz" :disabled="!isAllAnswered"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        Nộp bài
                    </button>
                </div>
            </div>

            <!-- Results -->
            <div v-else class="space-y-6">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Hoàn thành bài kiểm tra!</h3>
                    <p class="mt-1 text-gray-500">Bạn đã trả lời đúng {{ calculateCorrectAnswers() }}/{{
                        lesson.quiz.questions.length }} câu</p>
                </div>

                <div class="space-y-4">
                    <div v-for="(question, index) in lesson.quiz.questions" :key="question.id"
                        class="border rounded-lg p-4" :class="{
                            'border-green-200 bg-green-50': isAnswerCorrect(question.id),
                            'border-red-200 bg-red-50': !isAnswerCorrect(question.id)
                        }">
                        <div class="flex items-start">
                            <div class="flex-0">
                                <svg class="h-5 w-5" :class="{
                                    'text-green-500': isAnswerCorrect(question.id),
                                    'text-red-500': !isAnswerCorrect(question.id)
                                }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        :d="isAnswerCorrect(question.id) ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12'" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    Câu {{ index + 1 }}: {{ question.question }}
                                </p>
                                <div class="mt-2 space-y-1">
                                    <p v-for="answer in question.answers" :key="answer.id" class="text-sm" :class="{
                                        'text-green-600': answer.isCorrect,
                                        'text-gray-500': !answer.isCorrect && userAnswers[question.id] === answer.id,
                                        'text-gray-400': !answer.isCorrect && userAnswers[question.id] !== answer.id
                                    }">
                                        <span class="mr-2">{{ answer.text }}</span>
                                        <span v-if="answer.isCorrect"
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            Đúng
                                        </span>
                                        <span v-else-if="userAnswers[question.id] === answer.id"
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                            Sai
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button @click="submitQuiz"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Nộp bài
                    </button>
                </div>
            </div>
        </div>
<!-- Thêm vào trong phần quiz section -->
<CodePracticeSection 
  :initial-code="initialCode"
  :hint="codeHint"
  :test-cases="codeTestCases"
/>
        <!-- Lesson Navigation -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between">
                <button @click="goToPrevLesson" :disabled="!prevLessonId"
                    class="flex items-center px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Bài trước
                </button>

                <button @click="goToNextLesson" :disabled="!nextLessonId"
                    class="flex items-center px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    Bài sau
                    <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Lesson List -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Chương học: {{ lesson.section.title }}</h3>
            <div class="space-y-2">
                <div v-for="item in lesson.section.lessons" :key="item.id"
                    class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 cursor-pointer" :class="{
                        'bg-indigo-50 border border-indigo-200': item.slug === lesson.slug
                    }">
                    <div class="flex items-center">
                        <div class="flex-0 w-8 h-8 rounded-full flex items-center justify-center" :class="{
                            'bg-indigo-100 text-indigo-600': item.slug === lesson.slug,
                            'bg-gray-100 text-gray-500': item.slug !== lesson.slug
                        }">
                            {{ item.order }}
                        </div>
                        <span class="ml-3 text-sm font-medium" :class="{
                            'text-indigo-900': item.slug === lesson.slug,
                            'text-gray-700': item.slug !== lesson.slug
                        }">
                            {{ item.title }}
                        </span>
                    </div>
                    <span v-if="item.duration" class="text-xs text-gray-500">
                        {{ item.duration }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>