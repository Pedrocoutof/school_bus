<script setup>
import { usePage } from '@inertiajs/vue3';
const { data, theads } = usePage().props;

defineProps({
    data: Array,
    theads: Array
});

console.log(data)
</script>

<template>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th v-for="(thead, index) in theads" :class="{
                'rounded-tl-lg': index === 0,
                'rounded-tr-lg': index === theads.length - 1,
            }"
                class="text-gray-600 py-3 bg-gray-100">{{ thead.name }}</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in data" :key="index">
                <td v-for="(thead, index) in theads" :key="index" class="border-b border-slate-100 py-4">{{ item[thead.value] }}</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped lang="scss">
</style>
