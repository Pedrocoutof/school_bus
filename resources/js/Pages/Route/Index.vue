<script setup>

import DestroyButton from "@/Components/DestroyButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import Create from "@/Pages/Driver/Create.vue";
import Details from "@/Pages/Route/Details.vue";
import {ref} from "vue";
import Timeline from "@/Pages/Route/Timeline.vue";

const components = {
    index: Table,
    create: Timeline,
    details: Details
};

const url = 'http://127.0.0.1:8000/api/routes';
const selectedId = ref(null);


const currentComponent = ref('index');
function switchComponent(componentName, id = null) {
    currentComponent.value = components[componentName] ? componentName : 'index';
    if (id) {
        selectedId.value = id;
    }
}

</script>

<template>
    <AuthenticatedLayout>
        <div class="py-3">
            <div class="mx-auto sm:px-6">
                <div class="flex justify-between bg-white overflow-hidden shadow sm:rounded-lg">
                    <div class="flex items-center text-gray-600">
                        <a href="#" @click.prevent="switchComponent('index')" class="p-6">
                            Gerenciamento de Rotas
                        </a>
                        <div class="flex items-center">
                            <div  v-if="currentComponent !== 'index'" >></div>
                            <div  v-if="currentComponent === 'create'" class="p-6 text-gray-700">Adicionando motorista</div>
                            <div  v-if="currentComponent === 'details'" class="p-6 text-gray-700">Detalhes do motorista</div>
                        </div>
                    </div>
                    <div v-if="currentComponent === 'index'" class="flex items-center pr-6">
                        <a href="#"
                           class="p-2 text-gray-900 border-2 rounded-xl border-gray-300 hover:border-indigo-400"
                           @click.prevent="switchComponent('create')">
                            Adicionar rota
                        </a>
                    </div>
                    <div v-if="currentComponent === 'details'" class="flex items-center pr-6 gap-x-4">
<!--                        <DestroyButton :switch-component="switchComponent" :url-destroy="route('api.drivers.destroy', { driver: selectedId })"></DestroyButton>-->
                    </div>
                </div>
            </div>
            <div class="mt-3 mx-auto sm:px-6">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <component :is="components[currentComponent]" :switch-component="switchComponent" :url="url" :id="selectedId"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">

</style>
