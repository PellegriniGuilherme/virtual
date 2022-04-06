<script setup>
    import { reactive } from 'vue'
    import { Inertia } from '@inertiajs/inertia'
    import Input from '@/Components/InputForm.vue';
    import Label from '@/Components/LabelForm.vue';
    import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import ButtonLink from '@/Components/ButtonLink.vue';
    import Button from '@/Components/Button.vue';
    import ValidationErrors from '@/Components/ValidationErrors.vue';
    import { Head, useForm } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        cliente: {
            id: Number,
            nome: String,
            cpf: String,
            email: String
        },
    });

    const form = useForm({
        nome: props.cliente.nome,
        cpf: props.cliente.cpf,
        email: props.cliente.email
    });

    const submit = () => {
        form.put(route('cliente.update', props.cliente.id), {
            onSuccess: () => form.reset(),
        });
    };
</script>

<template>
    <Head title="Editar Cliente" />

    <AuthenticatedLayout>
        <div class="p-5">
            <div class="title">
                EDITANDO CLIENTE
            </div>

            <ValidationErrors class="mb-4 w-full mx-auto sm:w-4/6" />

            <form @submit.prevent="submit" class="w-full h-full max-w-lg bg-gray-50 border shadow-md rounded-md px-8 pt-6">
                <div class="form">
                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="nome" value="Nome" />
                        <Input id="nome" type="text" class="w-full" v-model="form.nome" required/>
                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="email" value="E-mail" />
                        <Input id="email" type="email" class="w-full" v-model="form.email" required />
                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="cpf" value="CPF" />
                        <Input id="cpf" type="text" class="w-full"  v-mask="'###.###.###-##'" v-model="form.cpf" required />
                    </div>
                </div>
                <div class="flex items-center justify-start mt-0">
                    <ButtonLink :href="route('cliente.index')" class="my-5 mx-3 text-center justify-center buttonRed">
                        Voltar
                    </ButtonLink>
                    <Button class="ml-auto mr-3 my-5 text-center justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Atualizar
                    </Button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>