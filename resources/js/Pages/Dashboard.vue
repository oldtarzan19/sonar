<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PlayerComponent from "@/Components/PlayerComponent.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="bg-linear-to-r from-[#C93B76] to-[#212936] w-screen h-screen flex justify-center items-center">
            <PlayerComponent/>
        </div>
    </AuthenticatedLayout>
</template>
