import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ui: {
                    bg: '#000000', // app háttér
                    surface: '#14213D', // card / panel / sidebar
                    accent: '#FCA311', // CTA / play / active
                    text: '#FFFFFF', // elsődleges szöveg
                    muted: '#E5E5E5', // másodlagos szöveg
                },
            },
        },
    },

    plugins: [forms],
};
