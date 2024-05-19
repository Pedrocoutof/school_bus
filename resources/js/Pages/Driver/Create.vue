<script setup>
    function getZipcodeData(zipcode) {
        axios({
            method: "get",
            url: "https://viacep.com.br/ws/"+ zipcode +"/json/",
        }).then(function (response) {
            fillFields(response.data)
        });
    }

    function fillFields(data) {
        document.getElementById('public_place').value = data.logradouro ?? "";
        document.getElementById('public_place').disabled = data.logradouro;

        document.getElementById('neighborhood').value = data.bairro ?? "";
        document.getElementById('neighborhood').disabled = data.logradouro;

        document.getElementById('city').value = data.localidade ?? "";
        document.getElementById('city').disabled = data.logradouro;

        document.getElementById('state').value = data.uf ?? "";
        document.getElementById('state').disabled = data.logradouro;
    }
    function searchZipCode() {
        let _inputZipcode = document.getElementById('zipcode').value;

        if (_inputZipcode.length === 8) {
            getZipcodeData(_inputZipcode);
        }
    }

</script>

<template>
    <form action="">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Informações básicas</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Insira as informações básicas de cadastro do motorista.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nome completo</label>
                        <div class="mt-2">
                            <input type="text" name="full_name" id="full_name" autocomplete="full_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Número de telefone</label>
                        <div class="mt-2">
                            <input type="text" name="phone" id="phone" autocomplete="phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="cep" class="block text-sm font-medium leading-6 text-gray-900">CEP</label>
                        <div class="mt-2">
                            <input maxlength="8" @keyup="searchZipCode()" type="text" name="zipcode" id="zipcode" autocomplete="zipcode" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="col-span-5">
                        <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Logradouro</label>
                        <div class="mt-2">
                            <input type="text" name="public_place" id="public_place" autocomplete="public_place" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Estado</label>
                        <div class="mt-2">
                            <input type="text" name="state" id="state" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                        <div class="mt-2">
                            <input type="text" name="neighborhood" id="neighborhood" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2 sm:col-1">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                        <div class="mt-2">
                            <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">Número/referência</label>
                        <div class="mt-2">
                            <input type="number" name="number" id="number" autocomplete="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                            <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="flex flex-col col-span-3">

                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="confirm_password" class="mt-4 block text-sm font-medium leading-6 text-gray-900">Confirme a senha</label>
                            <div class="mt-2">
                                <input type="password" name="confirm_password" id="confirm_password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
