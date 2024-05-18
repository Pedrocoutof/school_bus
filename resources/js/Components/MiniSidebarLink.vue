<script setup>
import { computed } from 'vue';
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
    "menu-toggle mt-3 size-12 border-2 rounded-xl ml-6 bg-white hover:bg-gray-100 border-indigo-700" :
    "menu-toggle mt-3 size-12 border-2 rounded-xl ml-6 bg-white hover:bg-gray-100")

const _icon = props.icon

</script>

<template>
    <button :class="_class" @click="ToggleMenu">
        <span class="material-icons-outlined" v-html="_icon"></span>
    </button>
</template>

<style scoped lang="scss">

</style>
