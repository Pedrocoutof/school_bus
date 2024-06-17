<script setup>
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue"
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputForm from "@/Components/InputForm.vue";

function searchZipCode() {}


const errors = ref(null);
const form = ref({
    'full_name': '',
    'phone': '',
    'zip_code': '',
    'city':'',
    'public_place': '',
    'state': '',
    'neighborhood': '',
    'number': '',
    'complement': '',
});

</script>

<template>
<FormSection title="Informações básicas do estudante">
    <div class="col-span-3">
        <InputLabel value="Nome completo"></InputLabel>
        <TextInput class="w-full" v-model="form.full_name"></TextInput>
        <InputError v-if="errors && errors.fullName" :message="errors.fullName[0]"></InputError>
    </div>
    <div class="col-span-3">
        <InputLabel value="Telefone"></InputLabel>
        <TextInput v-mask="'(00) 00000-0000'" v-model="form.phone"></TextInput>
        <InputError v-if="errors && errors.phone" :message="errors.phone[0]"></InputError>
    </div>
</FormSection>
    <FormSection class="mt-6" title="Informações de endereço"
                 description="Insira as informações básicas de endereço do motorista.">

        <div class="col-span-2 w-full">
            <InputLabel value="CEP"></InputLabel>
            <TextInput class="w-full" @keyup="searchZipCode" v-mask="'00000-000'" v-model="form.zip_code"></TextInput>
            <InputError v-if="errors && errors.zip_code" :message="errors.zip_code[0]"></InputError>
        </div>


        <div class="col-span-3 w-full">
            <InputLabel value="Cidade"></InputLabel>
            <TextInput class="w-full" v-model="form.city"></TextInput>
            <InputError v-if="errors && errors.city" :message="errors.city[0]"></InputError>
        </div>


        <div class="col-span-3 w-full">
            <InputLabel value="Logradouro"></InputLabel>
            <TextInput class="w-full" v-model="form.public_place"></TextInput>
            <InputError v-if="errors && errors.public_place" :message="errors.public_place[0]"></InputError>
        </div>

        <div class="col-span-3">
            <InputLabel value="Estado"></InputLabel>
            <TextInput class="w-full" v-model="form.state"></TextInput>
            <InputError v-if="errors && errors.state" :message="errors.state[0]"></InputError>
        </div>


        <div class="col-span-3 w-full">
            <InputLabel value="Bairro"></InputLabel>
            <TextInput class="w-full" v-model="form.neighborhood"></TextInput>
            <InputError v-if="errors && errors.neighborhood" :message="errors.neighborhood[0]"></InputError>
        </div>


        <div class="col-span-3 w-full">
            <InputLabel value="Número"></InputLabel>
            <TextInput class="w-full" v-model="form.number"></TextInput>
            <InputError v-if="errors && errors.number" :message="errors.number[0]"></InputError>
        </div>



        <div class="col-span-3 w-full">
            <InputLabel value="Complemento"></InputLabel>
            <TextInput class="w-full" v-model="form.complement"></TextInput>
            <InputError v-if="errors && errors.complement" :message="errors.complement[0]"></InputError>
        </div>
    </FormSection>

    <div class="mt-6 flex items-center justify-end gap-x-6 col-span-full justify-end">
        <SecondaryButton> Cancelar </SecondaryButton>
        <PrimaryButton> Salvar </PrimaryButton>
    </div>
</template>

<style scoped lang="scss">

</style>
