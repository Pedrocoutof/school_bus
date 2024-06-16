<script setup>
import FormSection from "@/Components/FormSection.vue";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import HourInput from "@/Components/HourInput.vue";
import Map from "@/Components/Map.vue";
import InputError from "@/Components/InputError.vue";
import axios from "axios";

const routeTitle = ref('');
const routeDescription = ref('');
const points = ref([]);

const errors = ref({});

const props = defineProps(['switchComponent']);

function onSubmit() {
    let body = {
        routeTitle: routeTitle.value,
        routeDescription: routeDescription.value,
        points: points.value.map((point) => ({
            "title": point.title,
            "description": point.description,
            "hour": point.hour,
            "lat": point.lat,
            "lng": point.lng,
        }))
    };

    axios.post(route('api.routes.store'), body).then((e) => {
        if (e.status === 201) {
            props.switchComponent('index');
        }
    }).catch((error) => {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            console.log("Erro inesperado", error);
        }
    })
}

function onRemove(index) {
    points.value.splice(index, 1);
}

function addPoint() {
    points.value.push({ title: '', description: '', hour: '', lat: '', lng: '' });
}

async function fillForm({ latlng }, index) {
    const lat = latlng.lat;
    const lng = latlng.lng;

    const response = await axios.get(`https://nominatim.openstreetmap.org/reverse`, {
        params: {
            format: 'json',
            lat: lat,
            lon: lng
        }
    });

    points.value[index].lat = lat;
    points.value[index].lng = lng;

    points.value[index].description = response.data.name ? response.data.name + " - (" + (response.data.address.town || response.data.address.city) + ")" : ""
}
</script>

<template>
    <FormSection title="Informações básicas da rota" description="Insira informações de identificação da rota.">
        <div class="col-span-2">
            <InputLabel value="Título"></InputLabel>
            <TextInput class="w-full" v-model="routeTitle"></TextInput>
            <InputError v-if="errors.routeTitle" :message="errors.routeTitle[0]"></InputError>
        </div>
        <div class="col-span-4">
            <InputLabel class="col-span-full" value="Descrição"></InputLabel>
            <TextInput class="w-full" v-model="routeDescription"></TextInput>
            <InputError v-if="errors.routeDescription" :message="errors.routeDescription[0]"></InputError>
        </div>
    </FormSection>

    <FormSection class="mt-6" title="Informações da rota" description="Insira os pontos de parada.">
        <div class="col-span-full"><InputError v-if="errors.points" :message="errors.points[0]"></InputError></div>
        <div class="col-span-full" v-for="(point, index) in points" :key="index">
            <div class="rounded-l-xl bg-gray-50 container mx-auto grid grid-cols-1 md:grid-cols-4 gap-x-2 col-span-full drop-shadow">
                <div class="md:col-span-2 flex flex-col space-y-3 ml-2">
                    <InputLabel value="Título"></InputLabel>
                    <TextInput v-model="point.title"></TextInput>
                    <InputError v-if="errors['points.' + index + '.title']" :message="errors['points.' + index + '.title'][0]"></InputError>

                    <InputLabel value="Descrição"></InputLabel>
                    <TextInput v-model="point.description"></TextInput>
                    <InputError v-if="errors['points.' + index + '.description']" :message="errors['points.' + index + '.description'][0]"></InputError>

                    <InputLabel value="Horário"></InputLabel>
                    <HourInput v-model="point.hour"></HourInput>
                    <InputError v-if="errors['points.' + index + '.hour']" :message="errors['points.' + index + '.hour'][0]"></InputError>

                    <div class="mx-auto col-span-full space-x-4">
                        <DangerButton @click="onRemove(index)">Remover</DangerButton>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <Map @onClickMap="(e) => fillForm(e, index)" col-span="col-span-2"></Map>
                    <InputError v-if="errors['points.' + index + '.lat']" :message="errors['points.' + index + '.lat'][0]"></InputError>
                    <InputError v-else-if="errors['points.' + index + '.lng']" :message="errors['points.' + index + '.lng'][0]"></InputError>
                </div>
            </div>
        </div>

        <div class="mt-6 flex col-span-full items-center justify-end gap-x-6">
            <PrimaryButton @click="addPoint">Adicionar parada</PrimaryButton>
        </div>
    </FormSection>

    <PrimaryButton @click="onSubmit">Salvar</PrimaryButton>
</template>

<style scoped lang="scss">

</style>
