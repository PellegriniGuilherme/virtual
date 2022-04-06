<script setup>
    import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import Button from '@/Components/Button.vue';
    import Link from '@/Components/ButtonLink.vue';
    import Status from '@/Components/Status.vue';
    import ValidationErrors from '@/Components/ValidationErrors.vue';
    import Paginate from '@/Components/Paginate.vue';
    import { Inertia } from '@inertiajs/inertia'
    import { Head, useForm } from '@inertiajs/inertia-vue3';

    const deleteProduto = (produto) => {
        Inertia.delete(route('produto.destroy', {
            id: produto.id,
        }));
    };

    const form = useForm({
        ids: []
    });

    const submit = () => {
        form.delete(route('produto.destroyMany'), {
            onSuccess: () => form.reset()
        });
    };

    const props = defineProps({
        produtos: Object,
    });
</script>

<template>
    <Head title="Produtos" />

    <AuthenticatedLayout>
        <div>
            <div class="title">
                PRODUTOS
            </div>

            <Status class="mb-4 w-full mx-auto sm:w-4/6" />

            <ValidationErrors class="mb-4 w-full mx-auto sm:w-4/6" />

            <div class="w-full flex justify-start px-3">
                <Button @click="submit()" :disabled="form.processing" v-if="produtos.data.length > 0" :class="{ 'opacity-25': form.processing }" class="mx-5 text-center justify-center buttonRed">
                    Deletar Selecionados
                </Button>
                <Link :href="route('produto.create')" class="mx-5 ml-auto text-center justify-center">
                    Criar Produto
                </Link>
            </div>
            <div class="w-auto bg-gray-50 mx-8 my-4 border shadow-md rounded-md px-3 py-6 text-center" v-if="produtos.data.length <= 0">
                Nenhum Produto Cadastrado.
            </div>
            <div class="w-auto bg-gray-50 mx-8 my-4 border shadow-md rounded-md px-3 pt-6" v-if="produtos.data.length > 0">
                <table class="w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Código Produto</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Nome</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Descrição</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Valor Unidade</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Ações</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b" v-for="(produto, key) in produtos.data" :key="key">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ produto.id }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ produto.nome }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ produto.descricao }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ produto.valor_unitario }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                <Link class="m-1" :href="route('produto.edit', produto.id)">
                                    <i class="bi bi-pencil-fill"></i>
                                </Link>
                                <Link class="m-1" :href="route('produto.show', produto.id)">
                                    <i class="bi bi-eye-fill"></i>
                                </Link>
                                <button class="buttonRed m-1" @click="deleteProduto(produto)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left flex">
                                <input type="checkbox" class="rounded border-gray-300 text-zinca-800 shadow-sm focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 mx-auto" v-model="form.ids" :value="produto.id" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-full">
                    <Paginate :data="produtos"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>