<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const props = defineProps(['url', 'id']);
const errors = ref({});

onMounted(async () => {
    try {
        const response = await axios.get(`${props.url}/${props.id}`);
        console.log(response.data)
    } catch (error) {
        console.error(error);
    }
});
</script>

<template>

</template>

<style scoped>
</style>
