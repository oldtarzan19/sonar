import {
    continuePlaying,
    pause,
    play,
    setVolume,
} from '@/lib/playbackEngine.js';
import { defineStore } from 'pinia';

export const usePlaybackStore = defineStore('playback', {
    state: () => ({
        isPlaying: false,
        currentTrack: {
            id: null,
            name: 'No tracks',
            audio_url: null,
            cover_image_url: null,
            artist: null,
            duration: 0,
            liked_date: null,
        },
        queue: [],
        isRepeated: false,
        isShuffled: false,
        volume: 50,
        isMuted: false,
        lastNonZeroVolume: 50,
    }),
    actions: {
        startPlayback(track) {
            this.setCurrentTrack(track);
            play(track.audio_url, {
                volume: this.volume,
                onEnd: () => {
                    console.log('ended');
                },
            });

            this.isPlaying = true;
        },
        togglePlayback() {
            this.isPlaying = !this.isPlaying;
            if (!this.isPlaying) {
                pause();
            } else {
                continuePlaying();
            }
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
        setCurrentTrack(track) {
            if (track.length === null) {
                this.currentTrack = {
                    id: null,
                    name: 'No tracks',
                    audio_url: null,
                    cover_image_url: null,
                    artist: null,
                    duration: 0,
                    liked_date: null,
                };
                console.log('No tracks');
                return;
            }
            this.currentTrack = track;
            console.log('setCurrentTrack track', track);
            console.log('setCurrentTrack current cratc', this.currentTrack);
        },
    },
});
