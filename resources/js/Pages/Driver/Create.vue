<script setup>
import { ref } from "vue";
import axios from "axios";
import InputForm from "@/Components/InputForm.vue";
import FormSection from "@/Components/FormSection.vue";

function getZipcodeData(zipcode) {
    axios({
        method: "get",
        url: "https://viacep.com.br/ws/" + zipcode + "/json/",
    }).then(function (response) {
        fillFields(response.data);
    });
}

function fillFields(data) {
    formData.value.public_place = data.logradouro ?? "";
    formData.value.neighborhood = data.bairro ?? "";
    formData.value.city = data.localidade ?? "";
    formData.value.state = data.uf ?? "";
}

function searchZipCode() {
    let _zipcode = formData.value.zip_code.toString();

    if (_zipcode.length === 8) {
        getZipcodeData(_zipcode);
    }
}

const props = defineProps(['switchComponent']);

const errors = ref({});
const formData = ref({
    full_name: '',
    phone: '',
    zip_code: '',
    public_place: '',
    neighborhood: '',
    city: '',
    state: ''
});
function handleSubmit() {
    axios.post('http://127.0.0.1:8000/api/drivers/store', formData.value)
        .then((response) => {
            if (response.status === 201) {
                props.switchComponent('index');
            }
        })
        .catch((error) => {
            if(error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
            else {
                console.log("Erro inesperado", error)
            }
        });
}
</script>

<template>
    <form @submit.prevent="handleSubmit">
        <FormSection title="Informações básicas" description="Insira as informações básicas de cadastro do motorista.">
            <InputForm :form="formData" label="Nome completo" name="full_name" cols="col-span-2" :errors="errors" />
            <InputForm maxlength="11" :form="formData" label="Número de telefone" type="number" name="phone" cols="col-span-2" :errors="errors" />
        </FormSection>

        <FormSection class="mt-6" title="Informações de endereço" description="Insira as informações básicas de endereço do motorista.">
            <InputForm maxlength="8" @keyup="searchZipCode" :form="formData" label="CEP" type="number" name="zip_code" cols="col-span-2" :errors="errors" />
            <InputForm :form="formData" label="Cidade" name="city" cols="col-span-2" :errors="errors" />
            <InputForm :form="formData" label="Logradouro" name="public_place" cols="col-span-2" :errors="errors" />
            <InputForm :form="formData" label="Estado" name="state" cols="col-span-1" :errors="errors" />
            <InputForm :form="formData" label="Bairro" name="neighborhood" cols="col-span-2" :errors="errors" />
            <InputForm :form="formData" label="Número" name="number" cols="col-span-1" :errors="errors" />
            <InputForm :form="formData" label="Complemento" name="complement" cols="col-span-2" :errors="errors" />
        </FormSection>

        <FormSection class="mt-6" title="Informações de login" description="Insira as informações básicas de login do motorista.">
            <InputForm :form="formData" label="Email" type="email" name="email" cols="col-span-2" :errors="errors" />
            <div class="col-span-full"></div>
            <InputForm :form="formData" label="Senha" type="password" name="password" cols="col-span-2" :errors="errors" />
            <InputForm :form="formData" label="Confirmar senha" type="password" name="password_confirmation" cols="col-span-2" :errors="errors" />
        </FormSection>


        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
            <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Salvar</button>
        </div>
    </form>
</template>

<style scoped lang="scss">

</style>
