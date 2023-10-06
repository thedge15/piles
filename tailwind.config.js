const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
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
            keyframes: {
                'fade': {
                    '0%': { opacity: 1 },
                    '100%': { opacity: 0 }
                }
            },
            animation: {
                'fade': 'fade 1.5s ease-in-out'
            }
        },
        // screens: {
        //     'tablet': '640px',
        //     // => @media (min-width: 640px) { ... }
        //
        //     'laptop': '1024px',
        //     // => @media (min-width: 1024px) { ... }
        //
        //     'desktop': '1280px',
        //     // => @media (min-width: 1280px) { ... }
        // },
    },


    plugins: [require('@tailwindcss/forms')],
};

