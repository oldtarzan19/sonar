<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PlayerComponent from '@/Components/PlayerComponent.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div
            class="bg-gradient-to-b from-ui-accent-primary/60 to-ui-bg to-35% flex min-h-full items-center justify-center rounded"
        >
            <PlayerComponent />
        </div>
    </AuthenticatedLayout>
</template>
