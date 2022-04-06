<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const status = computed(() => usePage().props.value.status);

</script>

<template>
    <div class="font-body text-gray-50 bg-lime-600 rounded-md p-5" v-if="status">
        <div class="font-medium  text-center">{{ status }}</div>
    </div>
</template>
