<script setup>
    import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import Button from '@/Components/Button.vue';
    import Link from '@/Components/ButtonLink.vue';
    import Status from '@/Components/Status.vue';
    import ValidationErrors from '@/Components/ValidationErrors.vue';
    import Paginate from '@/Components/Paginate.vue';
    import { Inertia } from '@inertiajs/inertia'
    import { Head, useForm } from '@inertiajs/inertia-vue3';

    const deleteCliente = (cliente) => {
        Inertia.delete(route('cliente.destroy', {
            id: cliente.id,
        }));
    };

    const form = useForm({
        ids: []
    });

    const submit = () => {
        form.delete(route('cliente.destroyMany'), {
            onSuccess: () => form.reset()
        });
    };

    const props = defineProps({
        clientes: Object
    });
</script>

<template>
    <Head title="Cientes" />

    <AuthenticatedLayout>
        <div>
            <div class="title">
                CLIENTES
            </div>

            <Status class="mb-4 w-full mx-auto sm:w-4/6" />

            <ValidationErrors class="mb-4 w-full mx-auto sm:w-4/6" />

            <div class="w-full flex justify-start px-3">
                <Button @click="submit()" v-if="clientes.data.length > 0" :disabled="form.processing" :class="{ 'opacity-25': form.processing }" class="mx-5 text-center justify-center buttonRed">
                    Deletar Selecionados
                </Button>
                <Link :href="route('cliente.create')" class="mx-5 ml-auto text-center justify-center">
                    Criar Cliente
                </Link>
            </div>
            <div class="w-auto bg-gray-50 mx-8 my-4 border shadow-md rounded-md px-3 py-6 text-center" v-if="clientes.data.length <= 0">
                Nenhum Cliente Cadastrado.
            </div>
            <div class="w-auto bg-gray-50 mx-8 my-4 border shadow-md rounded-md px-3 pt-6" v-if="clientes.data.length > 0">
                <table class="w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Código Cliente</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Nome</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">CPF</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">E-mail</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Ações</th>
                            <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b" v-for="(cliente, key) in clientes.data" :key="key">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ cliente.id }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ cliente.nome }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ cliente.cpf }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ cliente.email }}</td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                <Link class="m-1" :href="route('cliente.edit', cliente.id)">
                                    <i class="bi bi-pencil-fill"></i>
                                </Link>
                                <Link class="m-1" :href="route('cliente.show', cliente.id)">
                                    <i class="bi bi-eye-fill"></i>
                                </Link>
                                <button class="buttonRed m-1" @click="deleteCliente(cliente)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left flex">
                                <input type="checkbox" class="rounded border-gray-300 text-zinca-800 shadow-sm focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 mx-auto" v-model="form.ids" :value="cliente.id" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-full">
                    <Paginate :data="clientes"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>