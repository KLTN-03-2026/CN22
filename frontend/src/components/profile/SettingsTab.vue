<template>
    <BaseCard>
      <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" v-model="profile.settings.notifications.email" />
        Nhận email thông báo
      </label>

      <button
        @click="$emit('update', 'settings')"
        class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
        Lưu cài đặt
      </button>
    </BaseCard>
</template>
<script setup>
import { ref, computed, onMounted } from 'vue'
import { useProfileStore } from '../../stores/useProfileStore.js'
import BaseCard from './BaseCard.vue'

</script>
<style>
    
</style>