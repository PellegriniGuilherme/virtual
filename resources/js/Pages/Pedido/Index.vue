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
        Inertia.delete(route('pedido.destroy', {
            id: produto.id,
        }));
    };

    const form = useForm({
        ids: []
    });

    const submit = () => {
        form.delete(route('pedido.destroyMany'), {
            onSuccess: () => form.reset()
        });
    };

    const props = defineProps({
        pedidos: Object
    });
</script>

<template>
    <Head title="Pedido" />

    <AuthenticatedLayout>
        <div>
            <div class="title">
                PEDIDOS
            </div>

            <Status class="mb-4 w-full mx-auto sm:w-4/6" />

            <ValidationErrors class="mb-4 w-full mx-auto sm:w-4/6" />

            <div class="w-full flex justify-start px-3">
                <Button @click="submit()" :disabled="form.processing" v-if="pedidos.data.length > 0" :class="{ 'opacity-25': form.processing }" class="mx-5 text-center justify-center buttonRed">
                    Deletar Selecionados
                </Button>
                <Link :href="route('pedido.create')" class="mx-5 ml-auto text-center justify-center">
                    Criar Pedido
                </Link>
            </div>
            <div class="w-auto bg-gray-50 mx-8 my-4 border shadow-md rounded-md px-3 py-6 text-center" v-if="pedidos.data.length <= 0">
                Nenhum Pedido Cadastrado.
            </div>
            <div class="w-auto bg-gray-50 mx-8 my-4 border shadow-md rounded-md px-3 pt-6" v-if="pedidos.data.length > 0">
                <table class="w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Código Pedido</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Cliente</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Data</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Produtos</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Ações</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b" v-for="(pedido, key) in pedidos.data" :key="key">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ pedido.id }}
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                {{ pedido.cliente.nome }}
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                {{ pedido.data }}
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                <Link class="m-1" :href="route('pedido.show', pedido.id)">
                                    <i class="bi bi-basket2"></i>
                                </Link>
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                <Link class="m-1" :href="route('pedido.edit', pedido.id)">
                                    <i class="bi bi-pencil-fill"></i>
                                </Link>
                                <Link class="m-1" :href="route('pedido.show', pedido.id)">
                                    <i class="bi bi-eye-fill"></i>
                                </Link>
                                <button class="buttonRed mx-1" @click="deleteProduto(pedido)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left flex">
                                <input type="checkbox" class="rounded border-gray-300 text-zinca-800 shadow-sm focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 mx-auto" v-model="form.ids" :value="pedido.id" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-full">
                    <Paginate :data="pedidos"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>