<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const errors = computed(() => usePage().props.value.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>

<template>
    <div class="font-body text-gray-50 bg-red-600 rounded-md p-5" v-if="hasErrors">
        <div class="font-medium  text-center">Ops, algo deu errado!</div>

        <ul class="mt-3 list-none list-inside text-sm">
            <li v-for="(error, key) in errors" :key="key">— {{ error }}</li>
        </ul>
    </div>
</template>
