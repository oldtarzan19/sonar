<script setup>
import { computed } from 'vue';
import { Heart } from 'lucide-vue-next';

const props = defineProps({
    userName: {
        required: true,
        type: String,
    },
    collectionName: {
        required: true,
        type: String,
    },
    numberOfSongs: {
        required: true,
        type: Number,
    },
    coverImageSrc: {
        required: false,
        type: String,
        default: null,
    },
});

const isDefaultCover = computed(() => !props.coverImageSrc);
</script>

<template>
    <div
        class="flex h-full w-full flex-row gap-7 rounded-t bg-gradient-to-b from-ui-accent-primary/50 to-ui-text/50 p-5"
    >
        <div
            class="flex h-52 w-52 items-center justify-center  bg-gradient-to-br from-ui-accent-primary via-ui-accent-secondary to-ui-bg p-1"
            v-show="isDefaultCover"
        >
            <Heart class="h-[40%] w-[40%] fill-white text-white" />
        </div>

        <img
            alt="Cover Image"
            class="h-52 w-52 rounded"
            :src="coverImageSrc"
            v-show="!isDefaultCover"
        />

        <div class="flex flex-col items-start justify-end text-white">
            <span>Műsorlista</span>
            <span class="-ml-2 text-8xl font-bold">{{ collectionName }}</span>
            <div class="flex flex-row gap-3">
                <span class="block font-semibold">{{ userName }}</span>
                <span class="block">-</span>
                <span class="block">{{ numberOfSongs }} dal</span>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
