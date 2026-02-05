<script setup>
import {
    Heart,
    Headphones,
    HeadphoneOff,
    Shuffle,
    SkipBack,
    SkipForward,
    Play,
    Pause,
    Repeat2,
} from 'lucide-vue-next';
import { SliderRange, SliderRoot, SliderThumb, SliderTrack } from 'reka-ui';
import { computed, ref, watch } from 'vue';

const isMuted = ref(false);
const playing = ref(false);
const isShuffled = ref(false);
const isRepeated = ref(false);
const progress = ref([0]);

const volumeSliderValue = ref([20]);
const startAndStopPlaying = () => {
    playing.value = !playing.value;
};
const changeRepeatedStatus = () => {
    isRepeated.value = !isRepeated.value;
};

const changeRepeatedShuffled = () => {
    isShuffled.value = !isShuffled.value;
};

const nextSong = () => {
    console.log('next song');
};

const prevSong = () => {
    console.log('prev song');
};

const currentTimeLabel = computed(() => {
    const totalSeconds = Math.floor(13);

    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;

    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
});

const durationLabel = computed(() => {
    const totalSeconds = Math.floor(130);

    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;

    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
});

watch(volumeSliderValue, (volumeSliderValue) => {
    isMuted.value = volumeSliderValue[0] === 0;
});

watch(isMuted, () => {
    volumeSliderValue.value[0] = 0;
})
</script>

<template>
    <div
        class="mx-1 grid h-24 w-full grid-cols-[auto_1fr_auto] items-center rounded bg-ui-surface px-3 text-ui-text"
    >
        <div class="flex flex-row items-center justify-start gap-2">
            <img
                src="https://picsum.photos/56/56"
                class="h-auto w-[56px] rounded"
            />
            <div class="flex flex-col overflow-hidden">
                <p class="text-ui-text">Move Your Body</p>
                <p class="text-ui-muted opacity-40">
                    Dimitri Vegas & Like Mike
                </p>
            </div>
            <Heart class="fill-red-800" />
        </div>
        <div class="w-full justify-self-center">
            <div class="flex h-full flex-col items-center space-y-3">
                <div class="flex flex-row items-center gap-6">
                    <div
                        class="relative cursor-pointer transition-transform duration-300 hover:scale-110 hover:text-ui-muted"
                        :class="{
                            'text-ui-accent-primary': isShuffled,
                        }"
                        @click="changeRepeatedShuffled"
                    >
                        <Shuffle />
                        <span
                            v-show="isShuffled"
                            class="absolute -bottom-2 left-1/2 h-1 w-1 -translate-x-1/2 rounded-full bg-ui-accent-primary"
                        ></span>
                    </div>
                    <div
                        class="cursor-pointer transition-transform duration-300 hover:scale-110 hover:text-ui-muted"
                        @click="prevSong"
                    >
                        <SkipBack />
                    </div>
                    <div
                        class="cursor-pointer rounded-full bg-ui-accent-primary p-2 transition-transform duration-300 hover:scale-110"
                        @click="startAndStopPlaying"
                    >
                        <Play v-show="!playing" class="fill-current" />
                        <Pause v-show="playing" class="fill-current" />
                    </div>
                    <div
                        class="cursor-pointer transition-transform duration-300 hover:scale-110 hover:text-ui-muted"
                        @click="nextSong"
                    >
                        <SkipForward />
                    </div>
                    <div
                        class="relative cursor-pointer transition-transform duration-300 hover:scale-110 hover:text-ui-muted"
                        :class="{
                            'text-ui-accent-primary': isRepeated,
                        }"
                        @click="changeRepeatedStatus"
                    >
                        <Repeat2 />
                        <span
                            v-show="isRepeated"
                            class="absolute -bottom-2 left-1/2 h-1 w-1 -translate-x-1/2 rounded-full bg-ui-accent-primary"
                        ></span>
                    </div>
                </div>
                <div
                    class="flex w-[50%] flex-row items-center justify-between gap-3"
                >
                    {{ currentTimeLabel }}
                    <SliderRoot
                        v-model="progress"
                        class="group relative flex h-2 w-full cursor-pointer touch-none select-none items-center gap-3"
                        :max="100"
                        :step="1"
                    >
                        <SliderTrack
                            class="relative h-2 grow rounded-full bg-stone-500/30"
                        >
                            <SliderRange
                                class="absolute h-full rounded-full bg-ui-accent-primary"
                            />
                        </SliderTrack>

                        <SliderThumb
                            class="block h-4 w-4 rounded-full bg-white opacity-0 shadow-sm hover:bg-stone-50 focus:shadow-[0_0_0_2px] focus:shadow-ui-accent-primary focus:outline-none group-hover:opacity-100"
                            aria-label="Progress"
                        />
                    </SliderRoot>
                    {{ durationLabel }}
                </div>
            </div>
        </div>
        <div class="flex flex-row items-center gap-3">
            <div
                class="cursor-pointer p-1 transition-transform duration-200 hover:scale-110"
                @click="
                    () => {
                        isMuted = !isMuted;
                    }
                "
            >
                <Headphones v-show="!isMuted" />
                <HeadphoneOff v-show="isMuted" />
            </div>
            <SliderRoot
                v-model="volumeSliderValue"
                class="relative flex h-2 w-[150px] cursor-pointer touch-none select-none items-center"
                :max="100"
                :step="1"
            >
                <SliderTrack
                    class="relative h-2 grow rounded-full bg-stone-500/30"
                >
                    <SliderRange
                        class="absolute h-full rounded-full bg-ui-accent-primary"
                    />
                </SliderTrack>
                <SliderThumb
                    class="block h-4 w-4 rounded-full bg-white shadow-sm hover:bg-stone-50 focus:shadow-[0_0_0_2px] focus:shadow-ui-accent-primary focus:outline-none"
                    aria-label="Volume"
                />
            </SliderRoot>
        </div>
    </div>
</template>

<style scoped></style>
