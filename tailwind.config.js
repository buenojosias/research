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
            },
            colors: {
                primary: "#1db5ad",
                "primary-content": "#000000",
                "primary-dark": "#168983",
                "primary-light": "#28ddd3",

                secondary: "#611db5",
                "secondary-content": "#e7d8f9",
                "secondary-dark": "#491689",
                "secondary-light": "#7928dd",

                background: "#eff1f1",
                foreground: "#fbfbfb",

                border: "#dde2e1",

                copy: "#232929",
                "copy-light": "#5e6e6d",
                "copy-lighter": "#849594",

                success: "#1db51d",
                warning: "#b5b51d",
                error: "#b51d1d",

                "success-content": "#d8f9d8",
                "warning-content": "#000000",
                "error-content": "#f9d8d8"
            },
        },
    },

    plugins: [forms],
};
