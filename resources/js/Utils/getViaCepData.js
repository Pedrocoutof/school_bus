import axios from "axios";
export async function getViaCepData(zipcode) {
    zipcode = zipcode.replace(/\D/g, '');
    let response = null;
    try {
        response = await axios
            .get(`https://viacep.com.br/ws/${zipcode}/json/`)
            .then((response) => response);
    } catch (e) { }

    if (response && response.status === 200) {
        return response.data;
    }

    return null
}

async function buscaCep(zipcode) {
    return
}
