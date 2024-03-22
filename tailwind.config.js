import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        require('./vendor/tallstackui/tallstackui/tailwind.config.js')
    ],

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/tallstackui/tallstackui/src/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    50: "#E5FBFA",
                    100: "#C6F6F3",
                    200: "#77E9E3",
                    300: "#22D3CA",
                    400: "#1DB5AD",
                    500: "#1BA7A0",
                    600: "#18958F",
                    700: "#15847E",
                    800: "#126E69",
                    900: "#0D4F4C",
                    950: "#083533",
                    content: "#000000",
                    dark: "#168983",
                    light: "#28DDD3"
                },
                'secondary': {
                    50: "#F4EDFC",
                    100: "#ECE0FA",
                    200: "#D1B4F3",
                    300: "#B080EB",
                    400: "#611DB5",
                    500: "#5C1BAB",
                    600: "#55199E",
                    700: "#42147B",
                    800: "#340F61",
                    900: "#230B42",
                    950: "#230B42",
                    content: "#E7D8F9",
                    light: "#7928DD",
                    dark: "#491689"
                },
                'success': {
                    50: "#E9FBE9",
                    100: "#CAF7CA",
                    200: "#88EC88",
                    300: "#22D722",
                    400: "#1DB51D",
                    500: "#1BA71B",
                    600: "#189518",
                    700: "#158415",
                    800: "#126E12",
                    900: "#0D4F0D",
                    950: "#093909",
                    content: "#D8F9D8"
                },
                'warning': {
                    50: "#F9F9DC",
                    100: "#F3F3B4",
                    200: "#E2E24B",
                    300: "#CFCF21",
                    400: "#B5B51D",
                    500: "#A7A71B",
                    600: "#959518",
                    700: "#848415",
                    800: "#6E6E12",
                    900: "#4F4F0D",
                    950: "#393909",
                    content: "#000000"
                },
                'error': {
                    50: "#FCEDED",
                    100: "#FAE0E0",
                    200: "#F3B4B4",
                    300: "#EA7B7B",
                    400: "#B51D1D",
                    500: "#A71B1B",
                    600: "#951818",
                    700: "#7F1414",
                    800: "#721212",
                    900: "#4F0D0D",
                    950: "#350808",
                    content: "#F9D8D8"
                },
                'copy': {
                    default: "#232929",
                    light: "#5E6E6D",
                    lighter: "#849594"
                },
                'copy-dark': {
                    default: "#FbFbFb",
                    light: "#D6DCDB",
                    lighter: "#9FACAC"
                },
                'foreground': {
                    default: "#FBFBFB",
                    dark: "#232929",
                },
                'background': {
                    default: "#EFF1F1",
                    dark: "#181B1B",
                },
                'border': {
                    default: "#DDE2E1",
                    dark: "3B4544",
                }
                // Pallet created with https://www.hover.dev/css-color-palette-generator and https://www.tints.dev/
            },
        },
    },

    plugins: [forms],
};
