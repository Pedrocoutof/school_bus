<script setup>
import {ref} from "vue";
import axios from "axios";
import Form from "@/Pages/Driver/Form.vue";

const props = defineProps(['switchComponent']);
const errors = ref({});
const formData = ref({
    full_name: '',
    phone: '',
    zip_code: '',
    public_place: '',
    neighborhood: '',
    city: '',
    state: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const isDisabled = ref(false);

function handleSubmit() {
    axios.post('http://127.0.0.1:8000/api/drivers/store', formData.value)
        .then((response) => {
            if (response.status === 201) {
                props.switchComponent('index');
            }
        })
        .catch((error) => {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            } else {
                console.log("Erro inesperado", error);
            }
        });
}
</script>

<template>
    <form @submit.prevent="handleSubmit">
        <Form :formData="formData" :errors="errors" :isDisabled="isDisabled"/>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
            <button type="submit"
                    class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                Salvar
            </button>
        </div>
    </form>
</template>

<style scoped>
</style>
