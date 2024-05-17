<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-3">
            <div class="mx-auto sm:px-6">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900">Você está logado!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
