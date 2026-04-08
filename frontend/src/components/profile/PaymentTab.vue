<template>
    <BaseCard>
      <p>Gói: {{ profile.paymentAccess.subscriptionStatus }}</p>

      <button
        v-if="profile.paymentAccess.subscriptionStatus === 'Free'"
        @click="$emit('update', 'payment')"
        class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
        Nâng cấp
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