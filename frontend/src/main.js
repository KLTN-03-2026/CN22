import { createApp } from 'vue'
import App from './App.vue'
import { router } from './router/index.js'
import Admin from './layouts/adminLayout.vue'
import Client from './layouts/clientLayout.vue'
import './style.css'
import Toaster from "@meforma/vue-toaster";
import { createPinia } from 'pinia'



const app = createApp(App)
const pinia = createPinia()

app.use(router)
app.use(pinia)
app.use(Toaster, {
    position: 'top-right',
});
app.provide('toast', app.config.globalProperties.$toast)
app.component("admin-layout", Admin);
app.component("client-layout", Client);
app.mount('#app')




