<script setup>
import { House, Search } from 'lucide-vue-next';
import { useTemplateRef } from 'vue';
import { Input } from '@/Components/ui/input/index.js';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const searchInput = useTemplateRef('searchInput');
const focusOnSearch = () => {
    searchInput.value.$el.focus();
};
</script>

<template>
    <div class="m-1 rounded bg-ui-surface px-4 text-ui-text sm:px-6 lg:px-4">
        <div class="flex h-16 flex-row items-center justify-between">
            <div>
                <Link :href="route('dashboard')">
                    <ApplicationLogo class="h-9 fill-current text-ui-text" />
                </Link>
            </div>

            <div class="flex flex-row items-center gap-4">
                <div
                    class="bg-ui-accent-secondary cursor-pointer rounded-full p-2 hover:bg-ui-accent-secondary/40 duration-300"
                >
                    <House />
                </div>

                <div
                    class="bg-ui-accent-secondary flex flex-row items-center gap-3 rounded-lg border border-transparent px-2 duration-300 focus-within:border-white"
                >
                    <Search class="cursor-pointer" @click="focusOnSearch" />
                    <Input
                        class="min-w-72 border-none focus:outline-none focus:ring-0 focus:ring-offset-0 focus-visible:ring-0 focus-visible:ring-offset-0"
                        ref="searchInput"
                        placeholder="Mit szeretnél lejátszani?"
                    />
                </div>
            </div>
            <div>jobb</div>
        </div>
    </div>
</template>

<style scoped></style>
