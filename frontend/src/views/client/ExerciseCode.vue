<template>
    <div class="bg-white rounded-xl shadow p-4 space-y-4">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Bài tập Coding</h3>
            <button @click="runCode" class="bg-indigo-600 text-white px-4 py-1 rounded-lg hover:bg-indigo-700">
                Run
            </button>
        </div>

        <!-- Editor -->
        <div class="border rounded-lg overflow-hidden">
            <div ref="editorRef" class="h-64"></div>
        </div>

        <!-- Submit -->
        <button @click="submitCode" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
            Submit
        </button>

        <!-- Test Cases -->
        <div>
            <h4 class="font-semibold text-gray-800 mb-2">Test Cases</h4>
            <div class="space-y-2">
                <div v-for="(tc, index) in testCases" :key="index"
                    class="p-3 rounded-lg border text-sm flex justify-between"
                    :class="tc.passed ? 'bg-green-50 border-green-400' : 'bg-red-50 border-red-400'">
                    <div>
                        <p>Input: {{ tc.input }}</p>
                        <p>Expected: {{ tc.expected }}</p>
                        <p>Output: {{ tc.output }}</p>
                    </div>
                    <span>{{ tc.passed ? '✔' : '✖' }}</span>
                </div>
            </div>
        </div>

        <!-- Result -->
        <div v-if="result" class="text-sm">
            <p>Score: {{ result.score }}%</p>
            <p :class="result.passed ? 'text-green-600' : 'text-red-600'">
                {{ result.passed ? 'Passed' : 'Failed' }}
            </p>
        </div>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

import { EditorView, basicSetup } from 'codemirror'
import { javascript } from '@codemirror/lang-javascript'

const editorRef = ref(null)
let editor

const code = ref('// viết hàm cộng 2 số\nfunction sum(a, b) {\n  return a + b\n}')

const testCases = ref([
    { input: '1,2', expected: 3, output: null, passed: false },
    { input: '5,7', expected: 12, output: null, passed: false }
])

const result = ref(null)

onMounted(() => {
    editor = new EditorView({
        doc: code.value,
        extensions: [basicSetup, javascript()],
        parent: editorRef.value,
        dispatch: (tr) => {
            editor.update([tr])
            code.value = editor.state.doc.toString()
        }
    })

    // load saved code
    const saved = localStorage.getItem('code')
    if (saved) {
        editor.dispatch({
            changes: { from: 0, to: editor.state.doc.length, insert: saved }
        })
    }
})

const runCode = () => {
    try {
        const userFunc = new Function(code.value + '; return sum')()

        testCases.value.forEach(tc => {
            const [a, b] = tc.input.split(',').map(Number)
            const output = userFunc(a, b)
            tc.output = output
            tc.passed = output === tc.expected
        })
    } catch (e) {
        alert('Code lỗi!')
    }
}

const submitCode = () => {
    runCode()

    const passedCount = testCases.value.filter(tc => tc.passed).length
    const score = Math.round((passedCount / testCases.value.length) * 100)

    result.value = {
        score,
        passed: score >= 70
    }

    // save code
    localStorage.setItem('code', code.value)
}
</script>
