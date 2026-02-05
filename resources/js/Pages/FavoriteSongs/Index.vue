<script setup>
import { Head } from '@inertiajs/vue3';
import { Play, Pause, Shuffle, Clock } from 'lucide-vue-next';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CollectionHeader from '@/Components/CollectionHeader.vue';
import { ref } from 'vue';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table/index.js';

const isPlaying = ref(false);
const isShuffled = ref(false);

const changeShuffledStatus = () => {
    isShuffled.value = !isShuffled.value;
};
const changePlayStatus = () => {
    isPlaying.value = !isPlaying.value;
};
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

            <div
                class="flex-1 bg-gradient-to-b from-ui-accent-secondary/50 to-black p-4"
            >
                <div class="mb-3 flex items-center justify-start gap-3">
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

                    <div
                        class="relative flex h-fit w-16 cursor-pointer items-center justify-center text-white transition-transform duration-300 hover:scale-110"
                        :class="{
                            'text-ui-accent-primary': isShuffled,
                        }"
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
                            <TableRow>
                                <TableHead class="w-12">#</TableHead>
                                <TableHead class="w-[35%]">Cím</TableHead>
                                <TableHead class="w-[30%]">Előadó</TableHead>
                                <TableHead class="w-[20%]"
                                    >Hozzáadás Dátuma</TableHead
                                >
                                <TableHead class="w-16 text-right"
                                    ><Clock
                                /></TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody class="border-b-black">
                            <TableRow>
                                <TableCell> 1 </TableCell>
                                <TableCell>
                                    <div
                                        class="flex flex-row items-center gap-3"
                                    >
                                        <img
                                            alt=""
                                            src="https://picsum.photos/46/46"
                                            class="rounded"
                                        />
                                        <p class="text-lg font-bold">
                                            DOMINATION
                                        </p>
                                    </div>
                                </TableCell>
                                <TableCell>
                                    <p class="font-semibold">HOLY PRIEST</p>
                                </TableCell>
                                <TableCell>
                                    <p class="font-semibold">2025.nov. 19.</p>
                                </TableCell>
                                <TableCell>
                                    <p class="font-semibold">2:48</p>
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell> 1 </TableCell>
                                <TableCell>
                                    <div
                                        class="flex flex-row items-center gap-3"
                                    >
                                        <img
                                            alt=""
                                            src="https://picsum.photos/46/46"
                                            class="rounded"
                                        />
                                        <p class="text-lg font-bold">
                                            DOMINATION
                                        </p>
                                    </div>
                                </TableCell>
                                <TableCell>
                                    <p class="font-semibold">HOLY PRIEST</p>
                                </TableCell>
                                <TableCell>
                                    <p class="font-semibold">2025.nov. 19.</p>
                                </TableCell>
                                <TableCell>
                                    <p class="font-semibold">2:48</p>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
