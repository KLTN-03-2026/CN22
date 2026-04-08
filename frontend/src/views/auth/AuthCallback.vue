<template>
    <div class="loading-container">
        <p>Đang xác thực, vui lòng chờ...</p>
    </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

onMounted(() => {
    const params = new URLSearchParams(window.location.search)
    const token = params.get('token')

    if (token) {
        localStorage.setItem('token', token)

        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

        router.push('/')
    } else {
        router.push('/signin')
    }
})
</script>

<style scoped>
.loading-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-size: 1.2rem;
}
</style>