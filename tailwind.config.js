import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Fraunces"', 'serif'],
            },
            colors: {
                mango: {
                    green: '#569118',  // Daun segar / aksen struktural
                    orange: '#FB6C00', // Aksen utama / CTA kontras
                    gold: '#F9B637',   // Warna dasar mangga matang
                    cream: '#FFDD9C',  // Background lembut / kartu sekunder
                }
            }
        },
    },
    plugins: [],
};
