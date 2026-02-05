<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CollectionHeader from '@/Components/CollectionHeader.vue';
</script>

<template>
    <Head title="Collection" />

    <AuthenticatedLayout>
        <div class="flex min-h-full flex-col rounded">
            <div class="h-60">
                <CollectionHeader
                    user-name="Zsofenszki Kristóf"
                    collection-name="Kedvelt dalok"
                    number-of-songs="2332"
                />
            </div>

            <div>dsadas</div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
