<script setup>
import { ref } from 'vue'
import SidebarLink from "@/Components/SidebarLink.vue";
import MiniSidebarLink from "@/Components/MiniSidebarLink.vue";

console.log(window.location.hash)
const is_expanded = ref(localStorage.getItem("is_expanded") === "true")
const ToggleMenu = () => {
    is_expanded.value = !is_expanded.value
    localStorage.setItem("is_expanded", is_expanded.value)
}
</script>

<template>
    <aside :class="`${is_expanded ? 'is-expanded' : ''}` ">
        <div class="menu-toggle-wrap flex items-start mt-3">
            <div v-if="!is_expanded" class="content shadow rounded-r-3xl ml-0 bg-white w-64 h-dvh">

                <button class="flex justify-start items-center text-gray-600 w-full hover:bg-gray-100 border-l-4" @click="ToggleMenu">
                    <span class="material-icons-outlined m-4">close</span><span class="font-medium">Fechar</span>
                </button>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto">
                <SidebarLink href="/" :active="route().current('dashboard')" :title="'Painel de controle'" :icon="'dashboard'"/>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto">
                <SidebarLink href="/" :active="route().current('busses')" :title="'Ônibus'" :icon="'directions_bus'"/>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto">
                <SidebarLink href="/" :active="route().current('students')" :title="'Estudantes'" :icon="'school'"/>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto">
                <SidebarLink href="/" :active="route().current('drivers')" :title="'Motoristas'" :icon="'car_rental'"/>
            </div>
            <div v-else>
                <button class="menu-toggle size-12 border-2 rounded-xl ml-6 bg-white hover:bg-gray-100" @click="ToggleMenu">
                    <span v-if="is_expanded" class="material-icons">menu</span>
                    <span v-else class="material-icons">close</span>
                </button>

                <MiniSidebarLink icon="'dashboard'" href="/" :active="route().current('dashboard')"/>
                <MiniSidebarLink icon="'directions_bus'" href="/busses" :active="route().current('busses')"/>
                <MiniSidebarLink icon="'school'" href="/" :active="route().current('students')"/>
                <MiniSidebarLink icon="'car_rental'" href="/" :active="route().current('drivers')"/>
            </div>


        </div>
    </aside>
</template>

<style lang="scss" scoped>
.menu-toggle-wrap {
    flex-direction: column;
    display: flex;
    justify-content: flex-start;
    margin-bottom: 1rem;
}

.menu-toggle {
    display: flex;
    justify-content: center;
    align-items: center;
}


</style>
