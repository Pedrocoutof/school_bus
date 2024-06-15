<script setup>
import Topbar from "@/Components/Topbar.vue";
import Sidebar from "@/Components/Sidebar.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <Topbar/>

            <div class="flex">
                <Sidebar/>

                <main class="w-full">
                    <slot />
                </main>
            </div>

        </div>
    </div>
</template>
