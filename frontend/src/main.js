// src/main.js
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { router } from './router/index.js'
import { useAuthStore } from './stores/auth.js'
import './style.css'
import App from './App.vue'


// Tạo app
const app = createApp(App)
const pinia = createPinia()

// Sử dụng plugins
app.use(pinia)
app.use(router)

// Global error handler
app.config.errorHandler = (err) => {
  console.error('Global error:', err)
}

// Mount
app.mount('#app')