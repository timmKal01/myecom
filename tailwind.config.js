import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // Kept as its own token (rather than inlining Figtree everywhere)
                // so any page can still ask for a "display" weight distinctly
                // from body text, even though both resolve to the same
                // typeface now that the whole site shares one look.
                display: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // One shared palette for the entire site (storefront, auth,
                // vendor, customer, admin). Every value is a CSS custom
                // property (see resources/css/app.css) so a single `.dark`
                // class swap re-themes every page that uses these tokens —
                // no per-page dark: variants required.
                canvas: 'rgb(var(--color-canvas) / <alpha-value>)',
                surface: 'rgb(var(--color-surface) / <alpha-value>)',
                line: 'rgb(var(--color-line) / <alpha-value>)',
                ink: 'rgb(var(--color-ink) / <alpha-value>)',
                'ink-muted': 'rgb(var(--color-ink-muted) / <alpha-value>)',
                // A fixed near-black, independent of the light/dark toggle —
                // for elements meant to stay a solid dark chip with white
                // text in both modes (buttons, badges, the footer band).
                // `ink` itself is a *text* color and inverts in dark mode,
                // so it isn't safe to reuse as a background for those.
                'ink-solid': '#111827',
                accent: 'rgb(var(--color-accent) / <alpha-value>)',
                'accent-dark': 'rgb(var(--color-accent-dark) / <alpha-value>)',
                'accent-soft': 'rgb(var(--color-accent-soft) / <alpha-value>)',
                positive: 'rgb(var(--color-positive) / <alpha-value>)',
                'positive-soft': 'rgb(var(--color-positive-soft) / <alpha-value>)',
                negative: 'rgb(var(--color-negative) / <alpha-value>)',
                'negative-soft': 'rgb(var(--color-negative-soft) / <alpha-value>)',

                // Aliases so the ~20 admin views (already written against
                // "admin-*" class names) automatically theme and go dark
                // along with everything else, with zero file changes.
                'admin-canvas': 'rgb(var(--color-canvas) / <alpha-value>)',
                'admin-surface': 'rgb(var(--color-surface) / <alpha-value>)',
                'admin-border': 'rgb(var(--color-line) / <alpha-value>)',
                'admin-ink': 'rgb(var(--color-ink) / <alpha-value>)',
                'admin-ink-muted': 'rgb(var(--color-ink-muted) / <alpha-value>)',
                'admin-accent': 'rgb(var(--color-accent) / <alpha-value>)',
                'admin-accent-dark': 'rgb(var(--color-accent-dark) / <alpha-value>)',
                'admin-accent-soft': 'rgb(var(--color-accent-soft) / <alpha-value>)',
                'admin-positive': 'rgb(var(--color-positive) / <alpha-value>)',
                'admin-positive-soft': 'rgb(var(--color-positive-soft) / <alpha-value>)',
                'admin-negative': 'rgb(var(--color-negative) / <alpha-value>)',
                'admin-negative-soft': 'rgb(var(--color-negative-soft) / <alpha-value>)',
            },
        },
    },

    plugins: [forms],
};
