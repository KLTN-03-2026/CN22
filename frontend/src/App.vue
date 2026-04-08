<template>
  <component :is="layoutComponent">
    <router-view />
  </component>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';

import ClientLayout from './layouts/clientLayout.vue';
import AdminLayout from './layouts/adminLayout.vue';
import BlankLayout from './layouts/blank.vue';

const route = useRoute();

const layoutComponent = computed(() => {
  const layoutName = route.meta.layout || 'client';

  switch (layoutName) {
    case 'blank':
      return BlankLayout;
    case 'admin':
      return AdminLayout;
    case 'client':
    default:
      return ClientLayout;
  }
});
</script>