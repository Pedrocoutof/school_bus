<script setup>
import { defineProps } from "vue";

const props = defineProps(['_class', 'label', 'type', 'name',  'form', "cols", "errors", "maxlength"]);
</script>

<template>
    <div :class="props.cols">
        <label class="block font-medium text-sm text-gray-700 {{props._class}}">{{props.label}}</label>
        <div class="mt-0.5">
            <input
                :maxlength="props.maxlength"
                :type="props.type ?? 'text'"
                :name="props.name"
                v-model="props.form[props.name]"
                :class="'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6' + $props._class ?? ''"
            />
        </div>
        <p v-if="props.errors && props.errors[props.name]" class="mt-2 text-sm text-red-600">{{ props.errors[props.name][0] }}</p>
    </div>
</template>

<style scoped lang="scss">

</style>
