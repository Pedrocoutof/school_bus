<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import FormSection from "@/Components/FormSection.vue";
import InputForm from "@/Components/InputForm.vue";

const props = defineProps(['url', 'id'])
const formData = ref({
    full_name: '',
    phone: '',
    zip_code: '',
    public_place: '',
    neighborhood: '',
    city: '',
    state: ''
});

const errors = ref({});

onMounted(async () => {
    try {
        const response = await axios.get(props.url + "/" + props.id);
        Object.keys(response.data).forEach((key) => formData.value[key] = response.data[key])

    } catch (error) {
        console.error(error);
    }
});

</script>

<template>
    <form>
        <FormSection title="Informações básicas" description="Insira as informações básicas de cadastro do motorista.">
            <InputForm :disabled="true" :form="formData" label="Nome completo" name="full_name" cols="col-span-2" :errors="errors" />
            <InputForm :disabled="true" maxlength="11" :form="formData" label="Número de telefone" type="number" name="phone" cols="col-span-2" :errors="errors" />
        </FormSection>

        <FormSection class="mt-6" title="Informações de endereço" description="Insira as informações básicas de endereço do motorista.">
            <InputForm :disabled="true" maxlength="8" :form="formData" label="CEP" type="number" name="zip_code" cols="col-span-2" :errors="errors" />
            <InputForm :disabled="true" :form="formData" label="Cidade" name="city" cols="col-span-2" :errors="errors" />
            <InputForm :disabled="true" :form="formData" label="Logradouro" name="public_place" cols="col-span-2" :errors="errors" />
            <InputForm :disabled="true" :form="formData" label="Estado" name="state" cols="col-span-1" :errors="errors" />
            <InputForm :disabled="true" :form="formData" label="Bairro" name="neighborhood" cols="col-span-2" :errors="errors" />
            <InputForm :disabled="true" :form="formData" label="Número" name="number" cols="col-span-1" :errors="errors" />
            <InputForm :disabled="true" :form="formData" label="Complemento" name="complement" cols="col-span-2" :errors="errors" />
        </FormSection>

        <FormSection class="mt-6" title="Informações de login" description="Insira as informações básicas de login do motorista.">
            <InputForm :disabled="true" :form="formData" label="Email" type="email" name="email" cols="col-span-2" :errors="errors" />
            <div class="col-span-full"></div>
            <InputForm :hidden="true" :disabled="true" :form="formData" label="Senha" type="password" name="password" cols="col-span-2" :errors="errors" />
            <InputForm :hidden="true" :disabled="true" :form="formData" label="Confirmar senha" type="password" name="password_confirmation" cols="col-span-2" :errors="errors" />
        </FormSection>


        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
            <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Salvar</button>
        </div>
    </form>
</template>

<style scoped lang="scss">

</style>
