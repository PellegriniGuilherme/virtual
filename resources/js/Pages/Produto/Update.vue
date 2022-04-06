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
        produto: {
            id: Number,
            nome: String,
            descricao: String,
            valor_unitario: String
        },
    });

    const form = useForm({
        nome: props.produto.nome,
        descricao: props.produto.descricao,
        valor_unitario: props.produto.valor_unitario
    });

    const submit = () => {
        form.put(route('produto.update', props.produto.id), {
            onSuccess: () => form.reset(),
        });
    };
</script>

<template>
    <Head title="Editar Produto" />

    <AuthenticatedLayout>
        <div class="p-5">
            <div class="title">
                EDITANDO PRODUTO
            </div>

            <ValidationErrors class="mb-4 w-full mx-auto sm:w-4/6" />

            <form @submit.prevent="submit" class="w-full h-full max-w-lg bg-gray-50 border shadow-md rounded-md px-8 pt-6">
                <div class="form">
                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="nome" value="Nome" />
                        <Input id="nome" type="text" class="w-full" v-model="form.nome" required/>
                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="descricao" value="Descrição" />
                        <Input id="descricao" type="text" class="w-full" v-model="form.descricao" required />
                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="valor_unitario" value="Valor Unitário" />
                        <Input id="valor_unitario" type="text" class="w-full" v-model="form.valor_unitario" required />
                    </div>
                </div>
                <div class="flex items-center justify-start mt-0">
                    <ButtonLink :href="route('produto.index')" class="my-5 mx-3 text-center justify-center buttonRed">
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