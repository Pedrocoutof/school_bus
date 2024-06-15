<script setup>
import Map from "./Map.vue"
import { ref } from "vue";
const description = ref(null);

async function fillForm({latlng})  {

    const lat = latlng.lat;
    const lng = latlng.lng;

    const response = await axios.get(`https://nominatim.openstreetmap.org/reverse`, {
        params: {
            format: 'json',
            lat: lat,
            lon: lng
        }
    });
    description.value = response.data.name ? response.data.name + " - (" + response.data.address.town + ")" :  ""
}

</script>

<template>
    <div class="rounded-l-xl bg-gray-50 container mx-auto grid grid-cols-1 md:grid-cols-4 gap-x-2 col-span-full drop-shadow">
        <div class="md:col-span-2 flex flex-col space-y-3 ml-2">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
