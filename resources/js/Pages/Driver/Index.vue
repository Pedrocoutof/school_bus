<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import Create from './Create.vue';

const components = {
    index: Table,
    create: Create,
};

const currentComponent = ref('index');

function switchComponent(componentName) {
    currentComponent.value = components[componentName] ? componentName : 'index';
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-3">
            <div class="mx-auto sm:px-6">
                <div class="flex justify-between bg-white overflow-hidden shadow sm:rounded-lg">
                    <div class="flex items-center text-gray-600">
                        <a href="#" @click.prevent="switchComponent('index')" class="p-6">
                            Gerenciamento de motoristas
                        </a>
                        <div v-if="currentComponent !== 'index'" class="flex items-center">
                            <div>></div>
                            <div class="p-6 text-gray-700">Adicionando motorista</div>
                        </div>
                    </div>
                    <div class="flex items-center pr-6">
                        <a href="#" class="p-2 text-gray-900 border-2 rounded-xl border-gray-300 hover:border-indigo-400" @click.prevent="switchComponent('create')">
                            Adicionar motorista
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-3 mx-auto sm:px-6">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <component :is="components[currentComponent]" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
