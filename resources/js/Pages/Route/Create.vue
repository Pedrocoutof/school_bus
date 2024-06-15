<script setup>
import FormSection from "@/Components/FormSection.vue";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import HourInput from "@/Components/HourInput.vue";
import Map from "@/Components/Map.vue";

const routeTitle = ref('')
const routeDescription = ref('')
const points = ref([]);

const props = defineProps(['switchComponent']);
console.log(props)
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
    console.log(body)
    axios.post(route('api.routes.store'), body).then((e) =>{

        if(e.status === 201) {
            props.switchComponent('index');
        } else {
            console.log(e)
        }

    })
}

function onRemove(index) {
    points.value.splice(index, 1);
}

function addPoint() {
    points.value.push({ title: '', description: '', hour: '', lat:'', lng:'' });
}

async function fillForm({latlng}, index)  {

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

    points.value[index].description = response.data.name ? response.data.name + " - (" + (response.data.address.town || response.data.address.city) + ")" :  ""
}

</script>

<template>
    <FormSection title="Informações básicas da rota" description="Insira informações de identificação da rota.">
        <div class="col-span-2">
            <InputLabel value="Título"></InputLabel>
            <TextInput class="w-full" v-model="routeTitle"></TextInput>
        </div>
        <div class="col-span-4">
            <InputLabel class="col-span-full" value="Descrição"></InputLabel>
            <TextInput class="w-full" v-model="routeDescription"></TextInput>
        </div>
    </FormSection>

    <FormSection class="mt-6" title="Informações da rota" description="Insira os pontos de parada.">
        <div class="col-span-full" v-for="(point, index) in points" >
            <div class="rounded-l-xl bg-gray-50 container mx-auto grid grid-cols-1 md:grid-cols-4 gap-x-2 col-span-full drop-shadow">
                <div class="md:col-span-2 flex flex-col space-y-3 ml-2">

                    <InputLabel value="Título"></InputLabel>
                    <TextInput v-model="point.title"></TextInput>
                    <InputLabel value="Descrição"></InputLabel>
                    <TextInput v-model="point.description"></TextInput>
                    <InputLabel value="Horário"></InputLabel>
                    <HourInput v-model="point.hour"></HourInput>

                    <div class="mx-auto col-span-full space-x-4">
                        <DangerButton @click="onRemove(index)">Remover</DangerButton>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <Map @onClickMap="(e) => fillForm(e, index)" col-span="col-span-2"></Map>
                </div>
            </div>
        </div>

        <div class="mt-6 flex col-span-full items-center justify-end gap-x-6" >
            <PrimaryButton @click="addPoint">Adicionar parada</PrimaryButton>
        </div>

    </FormSection>

    <PrimaryButton @click="onSubmit">Salvar</PrimaryButton>

</template>

<style scoped lang="scss">

</style>
