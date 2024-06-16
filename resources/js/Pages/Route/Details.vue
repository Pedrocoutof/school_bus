<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import FormSection from "@/Components/FormSection.vue";
import TrackLine from "@/Components/TrackLine.vue";
import TrackLineItem from "@/Components/TrackLineItem.vue";

const props = defineProps(['url', 'id']);

const formData = ref({
    title: '',
    description: '',
    locations: {}
});

onMounted(async () => {
    try {
        const response = await axios.get(`${props.url}/${props.id}`);
        formData.value.title = response.data.title;
        formData.value.description = response.data.description;
        formData.value.locations = response.data.locations;
    } catch (error) {
        console.error(error);
    }
});
</script>

<template>
    <FormSection :title="formData.title" :description="formData.description">
    <div class="col-span-full space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
        <TrackLine :locations="formData.locations"></TrackLine>
    </div>
    </FormSection>
</template>
<style scoped>
</style>
