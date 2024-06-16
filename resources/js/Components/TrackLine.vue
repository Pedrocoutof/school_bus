<script setup>
import TimelineItem from "@/Components/TrackLineItem.vue";

const props = defineProps({
    "locations": {
        type: Object,
        required: true,
    }
});

function getIcon(index) {
    return index === 0 ? "flag" :
        index === props.locations.length - 1 ? "flag_circle" :
        "location_on"
}

</script>

<template>
    <timeline-item v-for="(location, index) in props.locations"
                   :title="location.title"
                   :description="location.description"
                   :hour="location.hour"
                   :icon="getIcon(index)">
    </timeline-item>
</template>

<style scoped lang="scss">

</style>
