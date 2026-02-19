import { play, setVolume, stop } from '@/lib/playbackEngine.js';
import { defineStore } from 'pinia';

export const usePlaybackStore = defineStore('playback', {
    state: () => ({
        isPlaying: false,
        currentTrack: null,
        queue: [],
        isRepeated: false,
        isShuffled: false,
        volume: 50,
        isMuted: false,
        lastNonZeroVolume: 50,
    }),
    actions: {
        stopPlayback() {
            stop();
        },
        startPlayback() {
            play(
                'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-9.mp3',
                {
                    volume: this.volume,
                    onEnd: () => {
                        console.log('ended');
                    },
                },
            );
        },
        togglePlayback() {
            if (this.isPlaying) {
                this.stopPlayback();
            } else {
                this.startPlayback();
            }
            this.isPlaying = !this.isPlaying;
        },
        toggleShuffle() {
            this.isShuffled = !this.isShuffled;
        },
        toggleRepeat() {
            this.isRepeated = !this.isRepeated;
        },
        setVolume(value) {
            const normalized = Math.max(0, Math.min(100, Number(value) || 0));
            this.volume = normalized;

            setVolume(normalized);

            if (normalized > 0) {
                this.lastNonZeroVolume = normalized;
                this.isMuted = false;
                return;
            }

            this.isMuted = true;
        },
        setMuted(muted) {
            if (muted) {
                if (this.volume > 0) {
                    this.lastNonZeroVolume = this.volume;
                }
                this.volume = 0;
                this.isMuted = true;
                setVolume(0);
                return;
            }

            this.isMuted = false;
            if (this.volume === 0) {
                this.volume = this.lastNonZeroVolume || 50;
            }
        },
        toggleMuted() {
            this.setMuted(!this.isMuted);
        },
    },
});
