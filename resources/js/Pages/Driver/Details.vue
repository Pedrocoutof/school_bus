<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Form from "@/Pages/Driver/Form.vue";

const props = defineProps(['url', 'id']);
const formData = ref({
    full_name: '',
    phone: '',
    zip_code: '',
    public_place: '',
    neighborhood: '',
    city: '',
    state: '',
    email: '',
});

const errors = ref({});
const isDisabled = ref(true);

onMounted(async () => {
    try {
        const response = await axios.get(`${props.url}/${props.id}`);
        Object.keys(response.data).forEach((key) => formData.value[key] = response.data[key]);
    } catch (error) {
        console.error(error);
    }
});
</script>

<template>
    <Form :formData="formData" :errors="errors" :isDisabled="isDisabled" />
</template>

<style scoped>
</style>
