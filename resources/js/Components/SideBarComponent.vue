<script setup>
import { Link } from '@inertiajs/vue3';
import { Plus, Heart } from 'lucide-vue-next';
import { Separator } from '@/Components/ui/separator/index.js';
</script>

<template>
    <div class="flex flex-col items-center space-y-3 p-2 pt-5">
        <Link class="flex h-[44px] w-[44px] items-center justify-center p-1">
            <Plus
                class="h-full w-full rounded-full bg-ui-accent-secondary p-1 duration-300 hover:bg-ui-accent-secondary/50"
            />
        </Link>
        <Link
            :href="route('collection.index')"
            class="flex h-[44px] w-[44px] items-center justify-center rounded bg-gradient-to-br from-ui-accent-primary via-ui-accent-secondary to-ui-bg p-1 shadow-lg transition-transform duration-200 hover:scale-105 hover:shadow-black"
        >
            <Heart class="fill-white" />
        </Link>
        <Separator class="bg-ui-accent-secondary" />

        <!-- This will be a link the the playlists -->
        <div class="flex flex-col items-center space-y-4">
            <img
                alt=""
                src="https://picsum.photos/303/288"
                class="w-[44px], h-[44px] rounded transition-transform hover:scale-105"
            />
            <img
                alt=""
                src="https://picsum.photos/301/288"
                class="w-[44px], h-[44px] rounded transition-transform hover:scale-105"
            />
            <img
                alt=""
                src="https://picsum.photos/302/288"
                class="w-[44px], h-[44px] rounded transition-transform hover:scale-105"
            />
        </div>
    </div>
</template>

<style scoped></style>
