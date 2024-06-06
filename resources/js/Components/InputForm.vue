<script setup>
import { ref, defineProps } from "vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps(['_class', 'label_text', 'type', 'name', 'errors', 'form']);

</script>

<template>
    <div>
        <label class="block font-medium text-sm text-gray-700 {{props._class}}">{{props.label_text}}</label>
        <div class="mt-2">
            <input
                :type="props.type ?? 'text'"
                :name="props.name"
                v-model="props.form[props.name]"
                :class="'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6' + $props._class ?? ''"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
