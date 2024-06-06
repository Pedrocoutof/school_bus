<script setup>
import { ref } from "vue";
import axios from "axios";
import InputForm from "@/Components/InputForm.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps(['switchComponent']);

function getZipcodeData(zipcode) {
    axios({
        method: "get",
        url: "https://viacep.com.br/ws/" + zipcode + "/json/",
    }).then(function (response) {
        fillFields(response.data);
    });
}

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

function fillFields(data) {
    formData.value.public_place = data.logradouro ?? "";
    formData.value.neighborhood = data.bairro ?? "";
    formData.value.city = data.localidade ?? "";
    formData.value.state = data.uf ?? "";
}

function searchZipCode() {
    let _inputZipcode = document.getElementById('zipcode').value;

    if (_inputZipcode.length === 8) {
        getZipcodeData(_inputZipcode);
    }
}

function submitForm() {
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
    <form id="form" @submit.prevent="submitForm" method="post">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Informações básicas</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Insira as informações básicas de cadastro do motorista.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <InputForm :form="formData" name="full_name" label_text="Nome completo"></InputForm>
                            <InputError v-if="errors && errors.full_name" :message="errors.full_name[0]"></InputError>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900"></label>
                        <div class="mt-2">
                            <InputForm :form="formData" name="phone" label_text="Número de telefone" type="number"></InputForm>
                            <InputError v-if="errors && errors.phone" :message="errors.phone[0]"></InputError>
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="cep" class="block text-sm font-medium leading-6 text-gray-900">CEP</label>
                        <div class="mt-2">
                            <input  v-model="formData.zip_code"  maxlength="8" @keyup="searchZipCode()" type="text" name="zip_code" id="zipcode" autocomplete="zipcode" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span v-if="errors.zip_code" class="text-red-600 text-sm">{{ errors.zip_code[0] }}</span>
                        </div>
                    </div>

                    <div class="col-span-5">
                        <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Logradouro</label>
                        <div class="mt-2">
                            <input type="text" v-model="formData.public_place" name="public_place"  id="public_place" autocomplete="public_place" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span v-if="errors.public_place" class="text-red-600 text-sm">{{ errors.public_place[0] }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Estado</label>
                        <div class="mt-2">
                            <input type="text" v-model="formData.state" name="state" id="state" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span v-if="errors.state" class="text-red-600 text-sm">{{ errors.state[0] }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                        <div class="mt-2">
                            <input type="text" v-model="formData.neighborhood" name="neighborhood" id="neighborhood" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span v-if="errors.neighborhood" class="text-red-600 text-sm">{{ errors.neighborhood[0] }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-2 sm:col-1">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                        <div class="mt-2">
                            <input type="text" v-model="formData.city" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span v-if="errors.city" class="text-red-600 text-sm">{{ errors.city[0] }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">Número/referência</label>
                        <div class="mt-2">
                            <input type="number" v-model="formData.number" name="number" id="number" autocomplete="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span v-if="errors.number" class="text-red-600 text-sm">{{ errors.number[0] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Informações acesso</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Insira os dados que serão necessários para acesso do usuário.</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input v-model="formData.email" type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span v-if="errors.email" class="text-red-600 text-sm">{{ errors.email[0] }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col col-span-3">

                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
                            <div class="mt-2">
                                <input v-model="formData.password" type="password" name="password" id="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <span v-if="errors.password" class="text-red-600 text-sm">{{ errors.password[0] }}</span>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="confirm_password" class="mt-4 block text-sm font-medium leading-6 text-gray-900">Confirme a senha</label>
                            <div class="mt-2">
                                <input v-model="formData.password_confirmation" type="password" name="password_confirmation" id="password_confirmation" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <span v-if="errors.password_confirmation" class="text-red-600 text-sm">{{ errors.password_confirmation[0] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
        </div>
    </form>
</template>

<style scoped lang="scss">

</style>
