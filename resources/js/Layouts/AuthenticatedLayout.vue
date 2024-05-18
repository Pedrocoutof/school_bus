<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link} from '@inertiajs/vue3';
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
