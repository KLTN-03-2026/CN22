import { defineStore } from 'pinia'
import { ref } from 'vue'
import { getProfileAPI, updateProfileAPI } from '../services/profileAPI.js'

export const useProfileStore = defineStore('profile', () => {
    const profile = ref(null)
    const isLoading = ref(false)
    const error = ref(null)

    const updateStatus = ref({
        message: '',
        type: null
    })

    async function fetchProfile() {
        try {
            isLoading.value = true
            error.value = null

            const res = await getProfileAPI()
            profile.value = res.data

        } catch (err) {
            error.value = err.response?.data?.message || 'Lỗi tải profile'
        } finally {
            isLoading.value = false
        }
    }

    async function updateProfile(payload, type = 'update') {
        try {
            const res = await updateProfileAPI(payload)

            profile.value = res.data

            updateStatus.value = {
                message: 'Cập nhật thành công',
                type: 'success'
            }
        } catch (err) {
            updateStatus.value = {
                message: 'Cập nhật thất bại',
                type: 'error'
            }
        }
    }

    return {
        profile,
        isLoading,
        error,
        updateStatus,
        fetchProfile,
        updateProfile
    }
})