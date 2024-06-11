<script setup>
const props = defineProps({
    'icon': {
        type: String,
        required: true
    },
    'title': {
        type: String,
        required: true
    },
    'description': {
        type: String,
        default: "",
        required: false
    }
})
</script>

<template>
    <div class="relative">
        <div class="md:flex items-center md:space-x-4 mb-3">
            <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                <!-- Icon -->
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow md:order-1">
                    <span class=" material-icons-outlined">
                        {{props.icon}}
                    </span>
                </div>
            </div>
            <!-- Title -->
            <div class="text-slate-500 ml-14"><span class="text-slate-900 font-bold">{{ props.title }}</span>
            <!--{{props.description}}-->
            </div>
        </div>
        <!-- Card -->
        <div class="bg-white p-4 rounded border border-slate-200 text-slate-500 shadow ml-14 md:ml-44">{{ props.description }}</div>
    </div>
</template>

<style scoped lang="scss">

</style>
