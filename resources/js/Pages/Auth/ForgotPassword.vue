<script setup>
import Button from '@/Components/Button.vue';
import GuestLayout from '@/Layouts/Guest.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import Status from '@/Components/Status.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Esqueci minha senha" />

        <div class="title">
            ESQUECI MINHA SENHA
        </div>

        <ValidationErrors class="mb-4" />

        <div class="mb-4 text-base font-body text-center text-gray-50">
            Esqueceu a sua senha? Acontece. Escreva seu e-mail abaixo e enviaremos pra você um link para gerarmos sua nova senha.
        </div>

        <Status class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <Label for="email" value="Email" />
                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button class="w-full text-center justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enviar E-mail
                </Button>
            </div>

            <div class="flex items-center justify-end mt-3">
                <Link :href="route('login')" class="linkGuest">
                    Lembrei minha senha
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
