<script setup>
import { Head, InfiniteScroll, usePage } from '@inertiajs/vue3';
import { useScroll, useElementVisibility, useMounted } from '@vueuse/core';
import { computed, onMounted, onUpdated } from 'vue';
import {
    Play,
    Pause,
    Shuffle,
    Clock,
    Check,
    EllipsisVertical,
} from 'lucide-vue-next';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CollectionHeader from '@/Components/CollectionHeader.vue';
import { ref } from 'vue';
import {
    Table,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table/index.js';
import { Skeleton } from '@/Components/ui/skeleton/index.js';
import { usePlaybackStore } from '@/stores/playbackStore.js';
import { storeToRefs } from 'pinia';

const page = usePage();
const infiniteScrollEnd = ref(null);
const getInfiniteScrollEndElement = () => infiniteScrollEnd.value;

const tracksCount = computed(() => {
    return String(page.props.tracks_count ?? 0);
});
const store = usePlaybackStore();
const { isPlaying, isShuffled } = storeToRefs(store);

const isMounted = useMounted();

// Sticky header refs
const scrollContainer = ref(null);
const syncScrollContainer = () => {
    scrollContainer.value = document.querySelector('main');
};
onMounted(syncScrollContainer);
onUpdated(syncScrollContainer);
const { y } = useScroll(scrollContainer, { behavior: 'smooth' });
const stickyHeaderOpacity = computed(() => {
    return Math.min(y.value / 200, 1);
});
const playButtonContainer = ref(null);
const playButtonContainerVisible = useElementVisibility(playButtonContainer, {
    threshold: 1.0,
});
const isPlayButtonContainerVisible = computed(() => {
    return isMounted.value && !playButtonContainerVisible.value;
});

const changeShuffledStatus = () => {
    isShuffled.value = !isShuffled.value;
};
const changePlayStatus = () => {
    store.togglePlayback();
};

const unFollowTrack = (trackId) => {
    console.log('This track has been unfollowed: ' + trackId);
};

const formatDuration = (duration) => {
    const minutes = Math.floor(duration / 60);
    const seconds = duration % 60;
    return `${String(minutes).padStart(2)}:${String(seconds).padStart(2, '0')}`;
};

const collection = computed(() => {
    return (page.props.tracks?.data ?? []).map((track) => ({
        ...track,
        duration: formatDuration(track.duration),
    }));
});
</script>

<template>
    <Head title="Collection" />

    <AuthenticatedLayout>
        <div class="relative flex min-h-full flex-col">
            <div
                class="fixed z-10 h-16 w-full pl-4 transition-colors"
                :style="{
                    backgroundColor: `rgba(0, 0, 0, ${stickyHeaderOpacity})`,
                }"
            >
                <Transition
                    enter-active-class="transition-opacity duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="transition-opacity duration-300"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        class="flex flex-row items-center gap-5"
                        v-show="isPlayButtonContainerVisible"
                    >
                        <div
                            class="flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-ui-accent-primary transition-transform duration-200 hover:scale-110"
                            @click="changePlayStatus"
                        >
                            <Play
                                v-show="!isPlaying"
                                class="fill-white text-white"
                            />
                            <Pause
                                v-show="isPlaying"
                                class="fill-white text-white"
                            />
                        </div>
                        <span class="text-xl font-bold text-white"
                            >Kedvelt dalok</span
                        >
                    </div>
                </Transition>
            </div>
            <div class="h-60">
                <CollectionHeader
                    user-name="Zsofenszki Kristóf"
                    collection-name="Kedvelt dalok"
                    :number-of-songs="tracksCount"
                />
            </div>

            <div
                class="flex-1 bg-gradient-to-b from-ui-accent-secondary/50 to-black p-4"
            >
                <div class="mb-3 flex items-center justify-start gap-3">
                    <div
                        class="flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-ui-accent-primary transition-transform duration-200 hover:scale-110"
                        @click="changePlayStatus"
                        ref="playButtonContainer"
                    >
                        <Play
                            v-show="!isPlaying"
                            class="fill-white text-white"
                        />
                        <Pause
                            v-show="isPlaying"
                            class="fill-white text-white"
                        />
                    </div>

                    <div
                        class="relative flex h-fit w-16 cursor-pointer items-center justify-center transition-transform duration-300 hover:scale-110"
                        :class="
                            isShuffled ? 'text-ui-accent-primary' : 'text-white'
                        "
                        @click="changeShuffledStatus"
                    >
                        <Shuffle />
                        <span
                            v-show="isShuffled"
                            class="absolute -bottom-2 left-1/2 h-1 w-1 -translate-x-1/2 rounded-full bg-ui-accent-primary"
                        ></span>
                    </div>
                </div>

                <div>
                    <Table class="text-white">
                        <TableHeader>
                            <TableRow class="text-white hover:bg-white/5">
                                <TableHead class="w-12">#</TableHead>
                                <TableHead class="w-[35%]">Cím</TableHead>
                                <TableHead class="w-[30%]">Előadó</TableHead>
                                <TableHead class="w-[20%]"
                                    >Hozzáadás Dátuma</TableHead
                                >
                                <TableHead class="w-32">
                                    <div
                                        class="flex items-center justify-center gap-5"
                                    >
                                        <div class="invisible">
                                            <Check :size="18" />
                                        </div>
                                        <Clock :size="18" />
                                        <div class="invisible">
                                            <EllipsisVertical :size="18" />
                                        </div>
                                    </div>
                                </TableHead>
                            </TableRow>
                        </TableHeader>

                        <InfiniteScroll
                            data="tracks"
                            as="tbody"
                            class="border-b-black [&_tr:last-child]:border-0"
                            :buffer="600"
                            :only-next="true"
                            :end-element="getInfiniteScrollEndElement"
                            v-slot="{ loadingNext }"
                            preserve-url
                        >
                            <TableRow
                                v-if="collection.length === 0"
                                class="hover:bg-transparent"
                            >
                                <TableCell colspan="5" class="py-8 text-center">
                                    Nincs kedvelt dal.
                                </TableCell>
                            </TableRow>
                            <template
                                v-for="(track, index) in collection"
                                :key="`track-${track.id}`"
                            >
                                <TableRow class="group hover:bg-white/5">
                                    <TableCell> {{ index + 1 }}</TableCell>
                                    <TableCell>
                                        <div
                                            class="flex flex-row items-center gap-3"
                                        >
                                            <img
                                                alt="Cover Image"
                                                :src="track.cover_image_url"
                                                class="h-11 w-11 rounded"
                                            />
                                            <p class="text-lg font-bold">
                                                {{ track.name }}
                                            </p>
                                        </div>
                                    </TableCell>
                                    <TableCell>
                                        <p class="font-semibold">
                                            {{ track.artist.artist_name }}
                                        </p>
                                    </TableCell>
                                    <TableCell>
                                        <p class="font-semibold">
                                            {{ track.liked_date }}
                                        </p>
                                    </TableCell>
                                    <TableCell>
                                        <div
                                            class="flex items-center justify-center gap-9"
                                        >
                                            <div
                                                class="opacity-0 transition-opacity group-hover:opacity-100"
                                                @click="unFollowTrack(track.id)"
                                            >
                                                <Check
                                                    :size="18"
                                                    class="rounded-full bg-ui-accent-primary p-1 text-ui-bg"
                                                />
                                            </div>
                                            <p class="font-semibold">
                                                {{ track.duration }}
                                            </p>
                                            <div
                                                class="opacity-0 transition-opacity group-hover:opacity-100"
                                            >
                                                <EllipsisVertical
                                                    :size="18"
                                                    class="cursor-pointer"
                                                />
                                            </div>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            </template>

                            <template v-if="loadingNext">
                                <TableRow
                                    v-for="n in 4"
                                    :key="`loading-next-${n}`"
                                >
                                    <TableCell>
                                        <Skeleton class="h-4 w-4 bg-white/20" />
                                    </TableCell>
                                    <TableCell>
                                        <div class="flex items-center gap-3">
                                            <Skeleton
                                                class="h-11 w-11 rounded bg-white/20"
                                            />
                                            <Skeleton
                                                class="h-4 w-32 bg-white/20"
                                            />
                                        </div>
                                    </TableCell>
                                    <TableCell>
                                        <Skeleton
                                            class="h-4 w-24 bg-white/20"
                                        />
                                    </TableCell>
                                    <TableCell>
                                        <Skeleton
                                            class="h-4 w-20 bg-white/20"
                                        />
                                    </TableCell>
                                    <TableCell>
                                        <div
                                            class="flex items-center justify-center gap-9"
                                        >
                                            <Skeleton
                                                class="h-4 w-4 rounded-full bg-white/20"
                                            />
                                            <Skeleton
                                                class="h-4 w-10 bg-white/20"
                                            />
                                            <Skeleton
                                                class="h-4 w-4 bg-white/20"
                                            />
                                        </div>
                                    </TableCell>
                                </TableRow>
                            </template>
                        </InfiniteScroll>
                    </Table>
                    <div ref="infiniteScrollEnd" class="h-10 w-full"></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
