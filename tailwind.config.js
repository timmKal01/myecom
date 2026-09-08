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

                // Separate palette for the internal admin dashboard only —
                // a cooler, denser "SaaS console" look distinct from the
                // warm storefront/vendor/customer brand above.
                'admin-canvas': '#f5f6fa',
                'admin-surface': '#ffffff',
                'admin-border': '#e5e7eb',
                'admin-ink': '#111827',
                'admin-ink-muted': '#6b7280',
                'admin-accent': '#3b5bff',
                'admin-accent-dark': '#2743cc',
                'admin-accent-soft': '#eef1ff',
                'admin-positive': '#16a34a',
                'admin-positive-soft': '#eafaf0',
                'admin-negative': '#dc2626',
                'admin-negative-soft': '#fdecec',
            },
        },
    },

    plugins: [forms],
};
