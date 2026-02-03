<script setup>
import { useMediaControls, useMouseInElement } from "@vueuse/core";
import { computed, nextTick, onMounted, ref, useTemplateRef, watch } from "vue";
import lostInCity from "../../assets/lost-in-city-lights-145038.mp3";
import forestLullaby from "../../assets/forest-lullaby-110624.mp3";


const tracks = [
  {
    id: 0,
    name: "Lost in the city lights",
    coverPath: 'https://picsum.photos/306/288',
    trackPath: lostInCity,
  },
  {
    id: 1,
    name: "Forest lullaby",
    coverPath: "https://picsum.photos/306/288",
    trackPath: forestLullaby,
  },
];

const currentTrackId = ref(1);
const currentTrack = computed(() => tracks[currentTrackId.value]);
const currentSrc = computed(() => tracks[currentTrackId.value].trackPath);

const audio = useTemplateRef("audio");
const bar = useTemplateRef("bar");

const { elementX, elementWidth, isOutside } = useMouseInElement(bar);
const { playing, currentTime, duration, volume } = useMediaControls(audio);

const seek = () => {
  if (isOutside.value || !duration.value) return;

  const percent = elementX.value / elementWidth.value;

  currentTime.value = percent * duration.value;
};

const currentTimeLabel = computed(() => {
  const totalSeconds = Math.floor(currentTime.value);

  const minutes = Math.floor(totalSeconds / 60);
  const seconds = totalSeconds % 60;

  return `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
});

const durationLabel = computed(() => {
  const totalSeconds = Math.floor(duration.value);

  const minutes = Math.floor(totalSeconds / 60);
  const seconds = totalSeconds % 60;

  return `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
});

const percentageLabel = computed(() => {
  const current = Math.floor(currentTime.value);
  const allDuration = Math.floor(duration.value);
  return (current / allDuration) * 100;
});

const nextSong = () => {
  const numberOfSongs = tracks.length;

  if (currentTrackId.value < numberOfSongs - 1) {
    currentTrackId.value++;
  } else {
    currentTrackId.value = 0;
  }
};

const prevSong = () => {
  const numberOfSongs = tracks.length;

  if (currentTrackId.value > numberOfSongs - 1) {
    currentTrackId.value--;
  } else {
    currentTrackId.value = 0;
  }
};

onMounted(() => {
  volume.value = 0.05;
});

watch(currentSrc, async () => {
  const el = audio.value;
  if (!el) return;

  // reset
  el.pause();
  el.currentTime = 0;

  await nextTick();

  // biztosítsuk, hogy újra betöltse
  el.load();

  try {
    await el.play();
    playing.value = true;
  } catch (err) {
    // Autoplay policy miatt ide eshet
    playing.value = false;
    console.warn("Nem tudtam elindítani (autoplay policy?):", err);
  }
});
</script>

<template>
  <div class="h-fit p-5 bg-[#121826a6] rounded-3xl flex flex-col shadow-lg">
    <img
      :src="tracks[currentTrackId].coverPath"
      class="rounded-2xl mb-4"
      alt=""
    />
    <div class="text-center">
      <p class="text-[#E5E7EB] font-semibold text-lg">
        {{ currentTrack.name }}
      </p>
      <p class="text-[#E5E7EB] opacity-25">Cosmo Sheldrake</p>
    </div>
    <div class="flex flex-col mb-7">
      <div
        class="flex flex-row justify-between text-[#E5E7EB] opacity-25 mx-1 text-[12px]"
      >
        <p>{{ currentTimeLabel }}</p>
        <p>{{ durationLabel }}</p>
      </div>
      <div
        ref="bar"
        class="w-full min-h-1 rounded"
        :style="{
          background: `linear-gradient(to right, #C93B76 ${percentageLabel}%, white ${percentageLabel}%)`,
        }"
        @click="seek"
      ></div>
    </div>
    <div class="flex flex-row gap-3 justify-center mb-3">
      <audio ref="audio" :src="currentSrc" />
      <img
        src="../../assets/Stop_and_play_fill-1.svg"
        alt=""
        class="hover:bg-[#121826a6] rounded-lg p-2 duration-240 cursor-pointer"
        @click="prevSong"
      />
      <img
        src="../../assets/Play_fill.svg"
        alt=""
        class="bg-[#C93B76] p-2 rounded-full hover:bg-[#C93B76]/60 duration-240 cursor-pointer"
        @click="playing = !playing"
      />
      <img
        src="../../assets/Stop_and_play_fill.svg"
        alt=""
        class="hover:bg-[#121826a6] rounded-lg p-2 duration-240 cursor-pointer"
        @click="nextSong"
      />
    </div>
  </div>
</template>

<style scoped></style>
