<script setup>
    import Input from '@/Components/InputForm.vue';
    import Label from '@/Components/LabelForm.vue';
    import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import ButtonLink from '@/Components/ButtonLink.vue';
    import Button from '@/Components/Button.vue';
    import ValidationErrors from '@/Components/ValidationErrors.vue';
    import { Head, useForm } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        pedido: Object
    });

    const form = useForm({
        id: props.pedido.id,
        cliente: props.pedido.cliente.nome
    });
</script>

<template>
    <Head title="Pedido" />

    <AuthenticatedLayout>
        <div class="p-5">
            <div class="title">
                PEDIDO
            </div>

            <ValidationErrors class="mb-4 w-full mx-auto sm:w-4/6" />

            <form @submit.prevent="submit" class="w-full h-full max-w-lg bg-gray-50 border shadow-md rounded-md px-8 pt-6">
                <div class="form">
                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="id" value="Código Produto" />
                        <Input id="id" type="text" class="w-full" v-model="form.id" required disabled/>
                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="nome" value="Cliente" />
                        <Input id="nome" type="text" class="w-full" v-model="form.cliente" required disabled/>
                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="data" value="Data" />
                        <Input id="data" type="text" class="w-full" v-model="form.data" :value="pedido.data" required disabled/>
                    </div>

                    <div class="w-full my-5 border-t border-zinc-400">
                        <div class="px-3 py-2" v-if="pedido.produtos.length > 0">
                            <table class="w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Código Produto</th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Produto</th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(produto, key) in pedido.produtos" :key="key">
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                            {{
                                                produto.produto.id
                                            }}
                                        </th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                            {{
                                                produto.produto.nome
                                            }}
                                        </th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                            {{produto.quantidade}}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="flex items-center justify-start mt-0">
                    <ButtonLink :href="route('pedido.index')" class="my-5 mx-3 text-center justify-center buttonRed">
                        Voltar
                    </ButtonLink>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
