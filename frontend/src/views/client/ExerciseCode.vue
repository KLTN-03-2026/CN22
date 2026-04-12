<script setup>
import { ref, onMounted } from 'vue'
import { useQuizStore } from '../../stores/useQuizStore'

const store = useQuizStore()

const editorRef = ref(null)
let editor

const code = ref('function sum(a, b) { return a + b }')

onMounted(async () => {
  await store.fetchQuestion(1) // lesson_id

  // init editor (giữ nguyên)
})

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
</script>
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