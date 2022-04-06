<script setup>
    import Input from '@/Components/InputForm.vue';
    import Label from '@/Components/LabelForm.vue';
    import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import ButtonLink from '@/Components/ButtonLink.vue';
    import Button from '@/Components/Button.vue';
    import ValidationErrors from '@/Components/ValidationErrors.vue';
    import Multiselect from '@vueform/multiselect';
    import { Head, useForm } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        produtos: Array,
        clientes: Array,
    });

    const form = useForm({
        cliente_id: null,
        produtos: []
    });

    const formProduto = useForm({
        produto_id: null,
        quantidade: null
    });

    const deleteProduto = (produto) => {
        form.produtos.findIndex((item) => {
            if(item.produto_id === produto.id) {
                form.produtos.splice(form.produtos.indexOf(item), 1);
            }
        });
    }

    const submitFormProduto = () => {

        let find = false;
        let error = false;
        formProduto.clearErrors();

        if(!formProduto.produto_id){
            formProduto.errors.produto_id = 'Selecione um produto';
            error = true;
        }
        if(!formProduto.quantidade){
            formProduto.errors.quantidade = 'Informe a quantidade';
            error = true;
        }

        form.produtos.findIndex((item) => {
            if(item.produto_id === formProduto.produto_id) {
                item.quantidade = parseInt(item.quantidade) + parseInt(formProduto.quantidade);
                find = true;
            }
        });
        
        if(!find && formProduto.produto_id && formProduto.quantidade) {
            form.produtos.push({
                produto_id: formProduto.produto_id,
                quantidade: formProduto.quantidade
            });
        }

        if(!error){
            formProduto.reset();
        }

    }

    const submit = () => {
        form.post(route('pedido.store'), {
            onSuccess: () => form.reset(),
        });
    };

</script>
<template>
    <Head title="Criar Produto" />

    <AuthenticatedLayout>
        <div class="p-5">
            <div class="title">
                CADASTRAR PEDIDO
            </div>

            <ValidationErrors class="mb-4 w-full mx-auto sm:w-4/6" />

            <form @submit.prevent="submit" class="w-full h-full max-w-lg bg-gray-50 border shadow-md rounded-md px-8 pt-6">
                <div class="form">

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full">
                        <Label for="cliente" value="Selecione o Cliente" />
                        <Multiselect
                            mode="single"
                            searchable
                            id="cliente"
                            placeholder="Selecione um cliente"
                            :options="
                                clientes.length > 0 ?
                                    clientes.map(cliente => ({
                                        value: cliente.id,
                                        label: cliente.nome,
                                    })) 
                                : []
                            "
                            v-model="form.cliente_id"
                            required
                        />
                    </div>
                    
                    <div class="w-full my-5 border-t border-zinc-400">
                        <div class="px-3 py-2" v-if="form.produtos.length > 0">
                            <table class="w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Produto</th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Quantidade</th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(produto, key) in form.produtos" :key="key">
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                            {{
                                                produtos[produtos.findIndex(i => i.id === produto.produto_id)].nome
                                            }}
                                        </th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                            {{produto.quantidade}}
                                        </th>
                                        <th class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                            <button class="buttonRed mx-1" type="button" @click="deleteProduto(produto)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="produtos" value="Adicionar Produto" />
                        <Multiselect
                            mode="single"
                            searchable
                            id="produtos"
                            placeholder="Selecione um produtos"
                            :options="
                                produtos.length > 0 &&
                                    produtos.map(produto => ({
                                        value: produto.id,
                                        label: produto.nome,
                                    }))
                                
                            "
                            v-model="formProduto.produto_id"
                        />
                        <div v-if="formProduto.errors.produto_id" class="text-red-600">{{ formProduto.errors.produto_id }}</div>

                    </div>

                    <div class="mt-4 px-3 mb-6 md:mb-0 w-full md:w-1/2 lg:w-1/3">
                        <Label for="quantidade" value="Quantidade" />
                        <Input id="quantidade" type="text" class="w-full" v-model="formProduto.quantidade"/>
                        <div v-if="formProduto.errors.quantidade" class="text-red-600">{{ formProduto.errors.quantidade }}</div>
                    </div>
                    
                    <div class="flex items-center justify-start mt-0 px-3 w-full">
                        <Button class="ml-auto my-5 text-center justify-center" type="button" @click="submitFormProduto()" :class="{ 'opacity-25': formProduto.processing }" :disabled="formProduto.processing">
                            Adicionar Produto
                        </Button>
                    </div>
                    
                </div>
                <div class="flex items-center justify-start mt-0">
                    <ButtonLink :href="route('pedido.index')" class="my-5 mx-3 text-center justify-center buttonRed">
                        Voltar
                    </ButtonLink>
                    <Button class="ml-auto mr-3 my-5 text-center justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Cadastrar
                    </Button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
