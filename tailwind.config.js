const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        maxWidth: {
            '5/12': '41.666667%',
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                body: ['Montserrat'],
                title: ['Orbitron']
            },
            boxShadow: {
                'inputGuest': '0px 0px 10px rgba(29, 78, 216, 0.25), 0px 4px 44px rgba(0, 0, 0, 0.25)'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
