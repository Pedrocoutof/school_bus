<script setup>

const props = defineProps(['title', 'description'])

</script>

<template>
    <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">{{ props.title }}</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">{{ props.description }}</p>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
