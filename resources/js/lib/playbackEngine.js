import { Howl } from 'howler';

let currentHowl = null;
let preloadedHowl = null;
let preloadedSrc = null;

export function play(src, { volume, onEnd } = {}) {
    let volume01 = volume / 100;

    if (preloadedHowl && preloadedSrc === src) {
        if (currentHowl && currentHowl !== preloadedHowl) currentHowl.unload();
        currentHowl = preloadedHowl;
        preloadedHowl = null;
        preloadedSrc = null;
    } else {
        if (currentHowl) currentHowl.unload();
        currentHowl = new Howl({
            src: [src],
            html5: true,
            volume: volume01,
            onend: onEnd,
        });
    }

    currentHowl.play();
}
export function pause() {
    if (!currentHowl) return;
    currentHowl.pause();
}

export function continuePlaying() {
    if (!currentHowl) return;
    currentHowl.play();
}
export function setVolume(volume01) {
    if (!currentHowl) return;
    currentHowl.volume(Math.max(0, Math.min(1, volume01 / 100)));
}
