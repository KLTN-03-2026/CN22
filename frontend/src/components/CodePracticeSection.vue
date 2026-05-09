<template>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium text-gray-900">Luyện tập code</h3>
            <button @click="resetCode" class="text-sm text-gray-500 hover:text-gray-700">
                Reset
            </button>
        </div>

        <!-- Code Editor -->
        <div class="mb-4">
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <!-- Editor Header -->
                <div class="bg-gray-800 px-4 py-2 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    </div>
                    <span class="text-gray-400 text-sm">main.js</span>
                </div>

                <!-- Code Area -->
                <div class="p-4">
                    <pre class="text-gray-300 text-sm overflow-x-auto">{{ userCode }}</pre>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-3 mb-4">
            <button @click="runCode"
                class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                Chạy code
            </button>
            <button @click="showHint = !showHint"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                {{ showHint ? 'Ẩn gợi ý' : 'Xem gợi ý' }}
            </button>
        </div>

        <!-- Hint Section -->
        <div v-if="showHint" class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
            <h4 class="text-sm font-medium text-blue-900 mb-2">Gợi ý:</h4>
            <p class="text-sm text-blue-700">{{ hint }}</p>
        </div>

        <!-- Output Section -->
        <div class="border rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-2 border-b">
                <span class="text-sm font-medium text-gray-700">Kết quả:</span>
            </div>
            <div class="p-4 bg-gray-900 min-h-[100px]">
                <pre v-if="output" class="text-green-400 text-sm whitespace-pre-wrap">{{ output }}</pre>
                <p v-else class="text-gray-400 text-sm">Chạy code để xem kết quả...</p>
            </div>
        </div>

        <!-- Test Cases -->
        <div v-if="testCases.length" class="mt-4">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Test cases:</h4>
            <div class="space-y-2">
                <div v-for="(test, index) in testCases" :key="index"
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm text-gray-600">{{ test.description }}</span>
                    <span class="text-sm font-medium" :class="{
                        'text-green-600': test.passed,
                        'text-red-600': !test.passed && test.run
                    }">
                        {{ test.passed ? '✓' : (test.run ? '✗' : '⏱') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

// Props
const props = defineProps({
    initialCode: {
        type: String,
        default: `// Viết code của bạn ở đây
console.log('Hello, Vue!')`
    },
    hint: {
        type: String,
        default: 'Sử dụng console.log() để in ra thông điệp'
    },
    testCases: {
        type: Array,
        default: () => [
            {
                description: 'In ra "Hello, Vue!"',
                passed: false,
                run: false
            }
        ]
    }
})

// State
const userCode = ref(props.initialCode)
const output = ref('')
const showHint = ref(false)
const testCases = ref(props.testCases)

// Methods
const runCode = () => {
    // Reset previous results
    output.value = 'Đang chạy...'

    // Simulate code execution
    setTimeout(() => {
        try {
            // Simple code evaluation (for demo only)
            // In real app, use a proper code execution service
            const result = eval(userCode.value)

            // Update test cases
            testCases.value = testCases.value.map(test => {
                if (test.description.includes('Hello')) {
                    return { ...test, passed: true, run: true }
                }
                return { ...test, run: true }
            })

            output.value = result !== undefined ? String(result) : 'Code chạy thành công!'
        } catch (error) {
            output.value = `Lỗi: ${error.message}`
        }
    }, 1000)
}

const resetCode = () => {
    userCode.value = props.initialCode
    output.value = ''
    showHint.value = false
    testCases.value = props.testCases
}
</script>