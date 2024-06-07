<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const props = defineProps(['url', 'id'])

onMounted(async () => {
    try {
       const response = await axios.get(props.url + "/" + props.id);
       console.log(response)
    } catch (error) {
        console.error(error);
    }
});

</script>

<template>

</template>

<style scoped lang="scss">

</style>
