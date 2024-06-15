<script setup>
import {ref, onMounted, defineEmits} from "vue";
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const mapContainer = ref(null);

const props = defineProps({
    'col-span': {
        default: "col-span-full"
    }
});

const emits = defineEmits({
    'onClickMap': {
        type: Function,
        default: () => {}
    }
})

onMounted(() => {
    const map = L.map(mapContainer.value).setView([-21.7291, -43.0673], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // const marker = L.marker([-21.7291, -43.0673]).addTo(map)
    //     .bindPopup('Um ponto de interesse.')
    //     .openPopup();

    map.on('click', async function (e) {
        emits('onClickMap', e)
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        L.popup()
            .setLatLng(e.latlng)
            .setContent("Latitude: " + lat + " <br> Longitude: " + lng)
            .openOn(map);

    });
});
</script>

<template>
    <div class="col-span-3">
        <div ref="mapContainer" id="map" style="height: 300px; width: 100%;"></div>
    </div>
</template>

<style scoped lang="scss">
</style>
