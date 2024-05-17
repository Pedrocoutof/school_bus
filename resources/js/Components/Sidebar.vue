<script setup>
import { ref } from 'vue'
const is_expanded = ref(localStorage.getItem("is_expanded") === "true")
const ToggleMenu = () => {
    console.log(is_expanded.value)
    is_expanded.value = !is_expanded.value
    localStorage.setItem("is_expanded", is_expanded.value)
}
</script>

<template>
    <aside :class="`${is_expanded ? 'is-expanded' : ''}` ">
        <div class="menu-toggle-wrap flex items-start mt-3">
            <div v-if="!is_expanded" class="content shadow rounded-r-3xl ml-0 bg-white w-64 h-dvh">
                <button class="flex justify-start items-center w-full text-gray-600 hover:bg-gray-100">
                    <span class="material-icons-outlined m-4">dashboard</span>
                    <p class="font-medium">DashBoard</p>
                </button>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto">
                <button class="flex justify-start items-center  text-gray-600 w-full hover:bg-gray-100">
                    <span class="material-icons-outlined m-4">
                        directions_bus
                    </span>
                    <p class="font-medium">Ônibus</p>
                </button>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto mb-0">
                <button class="flex justify-start items-center  text-gray-600 w-full hover:bg-gray-100">
                    <span class="material-icons-outlined m-4">
                        school
                    </span>
                    <p class="font-medium">Estudantes</p>
                </button>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto">
                <button class="flex justify-start items-center  text-gray-600 w-full hover:bg-gray-100">
                    <span class="material-icons-outlined m-4">
                        car_rental
                    </span>
                    <p class="font-medium">Motoristas</p>
                </button>
                <hr class="text-gray-400 h-0.5 w-4/5 m-auto">
            </div>
            <button class="menu-toggle size-12 border-2 rounded-xl ml-6 bg-white hover:bg-gray-100" @click="ToggleMenu">
                <span v-if="is_expanded" class="material-icons">menu</span>
                <span v-else class="material-icons">close</span>
            </button>
        </div>
    </aside>
</template>

<style lang="scss" scoped>
.menu-toggle-wrap {
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
