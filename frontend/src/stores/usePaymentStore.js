// stores/usePaymentStore.js
import { defineStore } from 'pinia'
import axios from '../router/api'

export const usePaymentStore = defineStore('payment', {
    state: () => ({
        qr: null,
        status: 0
    }),

    actions: {
        async createQR(orderId) {
            const res = await axios.post('/payments/sepay/create', {
                order_id: orderId
            })

            this.qr = res.data.qr_code
        },

        async checkStatus(orderId) {
            const res = await axios.get(`/orders/${orderId}`)
            this.status = res.data.status
        }
    }
})