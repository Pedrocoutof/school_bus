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
});

const _class = computed(() => props.active ?
    "menu-toggle mt-3 text-gray-600 size-12 border-2 rounded-xl ml-6 bg-white hover:bg-gray-100 border-indigo-700" :
    "menu-toggle mt-3 text-gray-600 size-12 border-2 rounded-xl ml-6 bg-white hover:bg-gray-100")

</script>

<template>
    <Link :class="_class" :href="props.href">
        <span class="material-icons-outlined" v-html="props.icon"></span>
    </Link>
</template>

<style scoped lang="scss">

</style>
