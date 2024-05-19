<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3'
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false
    },
    icon: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: true
    }

});

const _class = computed(() => props.active ?
    "flex justify-start items-center w-full text-gray-600 hover:bg-gray-100 border-l-4 border-indigo-700" :
    "flex justify-start items-center text-gray-600 w-full hover:bg-gray-100 border-l-4 border-transparent")

const _icon = props.icon
const _title = props.title
</script>

<template>
    <Link :class="_class" :href="props.href">
        <span class="material-icons-outlined m-4" v-html="_icon">
        </span>
        <p class="font-medium" v-html="_title"></p>
    </Link>
</template>

<style scoped lang="scss">

</style>
