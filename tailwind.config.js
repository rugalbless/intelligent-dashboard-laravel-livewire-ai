import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import filters from 'tailwindcss-filters';


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
            backdropFilter: {
                'none': 'none',
                'blur-saturate': 'blur(16px) saturate(180%)',
            },
            dropShadow: {
                'custom': '2px 2px 4px rgba(0, 0, 0, 0.5)',
            }
        },
    },

    variants: {
        backdropFilter: ['responsive'],
    },

    plugins: [
        forms,
        filters,
    ],
};
