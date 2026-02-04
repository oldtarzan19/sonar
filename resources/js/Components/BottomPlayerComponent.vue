<script setup>
import { Heart, Headphones, HeadphoneOff } from 'lucide-vue-next';
import { SliderRange, SliderRoot, SliderThumb, SliderTrack } from 'reka-ui';
import { ref, watch } from 'vue';

const muted = ref(false);
const volumeSliderValue = ref([20]);
watch(volumeSliderValue, (volumeSliderValue) => {
    console.log(volumeSliderValue);
});
</script>

<template>
    <div
        class="mx-1 grid h-20 w-full grid-cols-[auto_1fr_auto] items-center rounded bg-ui-surface px-3 text-ui-text"
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
        <div class="justify-self-center">Közép</div>
        <div class="flex flex-row items-center gap-3">
            <div
                class="cursor-pointer rounded p-1 duration-200 hover:bg-ui-accent-secondary"
                @click="
                    () => {
                        muted = !muted;
                    }
                "
            >
                <Headphones v-show="!muted" />
                <HeadphoneOff v-show="muted" />
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
