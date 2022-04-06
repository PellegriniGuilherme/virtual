<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <div class="w-auto bg-gray-50 mx-8 my-4 border shadow-md rounded-md px-5 py-8">
            <h1 class="font-title w-full text-2xl text-center bg-auto bg-center bg-no-repeat my-7 px-6">Bem vindo a Virtual!</h1>
            <p class="block uppercase tracking-wide text-zinc-800 text-xs font-bold mb-2 text-center">
                Sua gestão de pedidos, clientes e produtos!
            </p>
        </div>
    </BreezeAuthenticatedLayout>
</template>
