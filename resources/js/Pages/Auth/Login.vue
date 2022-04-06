<script setup>
import Button from '@/Components/Button.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/Guest.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import Status from '@/Components/Status.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div class="title">
            LOGIN
        </div>

        <ValidationErrors class="mb-4" />

        <Status class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <Label for="email" value="E-mail" />
                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <Label for="password" value="Password" />
                <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button class="w-full text-center justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </Button>
            </div>

            <div class="flex items-center justify-between mt-3">
                <Link v-if="canResetPassword" :href="route('password.request')" class="linkGuest">
                    Esqueci minha senha
                </Link>

                <Link :href="route('register')" class="linkGuest">
                    Registre-se
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>