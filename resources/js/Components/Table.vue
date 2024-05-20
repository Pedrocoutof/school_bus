<script setup>

import {ref, onMounted} from "vue";

const theads = ref();
const data = ref();

onMounted(async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/drivers');
        theads.value = Object.keys(response.data[0]);
        data.value = response.data
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});
</script>

<template>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th v-for="(thead, index) in theads"
                :class="{
                    'rounded-tl-lg': index === 0,
                    'rounded-tr-lg': index === theads.length - 1,
                }"
                class="text-gray-600 py-3 bg-gray-100 text-start pl-2">{{ thead }}</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in data" :key="index">
                <td v-for="(value, key) in row" class="border-b border-slate-100 py-4 pl-2" :key="key">{{ value }}</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped lang="scss">
</style>
