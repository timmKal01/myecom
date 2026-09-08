import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['"Cormorant Garamond"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // A warm, premium neutral + gold accent — kept as named
                // aliases (rather than raw stone/amber classes everywhere)
                // so the storefront's palette is easy to retune from one
                // place later.
                ink: '#1c1917',
                'ink-muted': '#57534e',
                accent: '#a16207',
                'accent-dark': '#854d0e',
                surface: '#ffffff',
                canvas: '#faf9f7',
                line: '#e7e3dd',
            },
        },
    },

    plugins: [forms],
};
