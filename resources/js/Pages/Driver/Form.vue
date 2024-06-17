<script setup>
import { ref } from "vue";
import axios from "axios";
import InputForm from "@/Components/InputForm.vue";
import FormSection from "@/Components/FormSection.vue";

const props = defineProps({
    formData: Object,
    errors: Object,
    isDisabled: Boolean,
});

function getZipcodeData(zipcode) {
    axios({
        method: "get",
        url: "https://viacep.com.br/ws/" + zipcode + "/json/",
    }).then(function (response) {
        fillFields(response.data);
    });
}

function fillFields(data) {
    props.formData.public_place = data.logradouro ?? "";
    props.formData.neighborhood = data.bairro ?? "";
    props.formData.city = data.localidade ?? "";
    props.formData.state = data.uf ?? "";
}

function searchZipCode() {
    let _zipcode = props.formData.zip_code.toString();

    if (_zipcode.length === 8) {
        getZipcodeData(_zipcode);
    }
}
</script>

<template>
    <form>
        <FormSection title="Informações básicas" description="Insira as informações básicas de cadastro do motorista.">
            <InputForm :disabled="isDisabled" :form="formData" label="Nome completo" name="full_name" cols="col-span-2"
                       :errors="errors"/>
            <InputForm :disabled="isDisabled" :form="formData" label="Número de telefone" type="text"
                       v-mask="'(00) 00000-0000'" name="phone" cols="col-span-2" :errors="errors"/>
        </FormSection>

        <FormSection class="mt-6" title="Informações de endereço"
                     description="Insira as informações básicas de endereço do motorista.">
            <InputForm :disabled="isDisabled" @keyup="searchZipCode" :form="formData" label="CEP"
                       type="text" v-mask="'00000-000'" name="zip_code" cols="col-span-2" :errors="errors"/>
            <InputForm :disabled="isDisabled" :form="formData" label="Cidade" name="city" cols="col-span-2"
                       :errors="errors"/>
            <InputForm :disabled="isDisabled" :form="formData" label="Logradouro" name="public_place" cols="col-span-2"
                       :errors="errors"/>
            <InputForm :disabled="isDisabled" :form="formData" label="Estado" name="state" cols="col-span-1"
                       :errors="errors"/>
            <InputForm :disabled="isDisabled" :form="formData" label="Bairro" name="neighborhood" cols="col-span-2"
                       :errors="errors"/>
            <InputForm :disabled="isDisabled" :form="formData" label="Número" name="number" cols="col-span-1"
                       :errors="errors"/>
            <InputForm :disabled="isDisabled" :form="formData" label="Complemento" name="complement" cols="col-span-2"
                       :errors="errors"/>
        </FormSection>

        <FormSection class="mt-6" title="Informações de login"
                     description="Insira as informações básicas de login do motorista.">
            <InputForm :disabled="isDisabled" :form="formData" label="Email" type="email" name="email" cols="col-span-2"
                       :errors="errors"/>
            <div class="col-span-full"></div>
            <InputForm :hidden="false" :disabled="isDisabled" :form="formData" label="Senha" type="password"
                       name="password" cols="col-span-2" :errors="errors"/>
            <InputForm :hidden="false" :disabled="isDisabled" :form="formData" label="Confirmar senha" type="password"
                       name="password_confirmation" cols="col-span-2" :errors="errors"/>
        </FormSection>
    </form>
</template>

<style scoped>
</style>
