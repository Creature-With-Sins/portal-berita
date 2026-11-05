import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // <-- Tambahkan baris ini biar Tailwind gak ngikutin mode gelap laptop
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Menjadikan Plus Jakarta Sans sebagai font default ('font-sans')
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    navy: '#0b0146',
                    'navy-dark': '#060026',
                    'navy-light': '#14076e',
                    'navy-soft': '#f0f2fa',
                    red: '#ff0000',
                    'red-dark': '#d90000',
                    'red-soft': '#fff0f0',
                },
            },
        },
    },

    plugins: [forms],
};
// ...
