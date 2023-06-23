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
            backgroundImage: {
                'north-pattern': "url('/storage/app/public/img/1674828128_top-fon-com-p-fon-dlya-prezentatsii-transneft-205.jpg')",
                'another-north-pattern': "url('/storage/app/public/img/b9840293ecc7a75ec1a73b77b71ec97b.jpg')",
                'tube-pattern': "url('/storage/app/public/img/1636525693618b667db4064.jpg')",
                'channel-pattern': "url('/storage/app/public/img/060_original.jpg')",
                'standard-pattern': "url('/storage/app/public/img/slide_5.jpg')",

            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
