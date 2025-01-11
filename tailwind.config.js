import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
                petrona: "'Petrona', 'sans-serif'",
            },
            textColor: {
                DEFAULT: '#1C1C1C',
            },
            fontSize: {
                base: '16px',
                'large-title-1': '120px',
                'large-title-2': '100px',
                'large-title-3': '80px',
                'heading-1': '70px',
                'heading-2': '50px',
                'heading-3': '35px',
                'heading-4': '28px',
                'title-1': '22px',
                'title-2': '18px',
                'body-1': '16px',
                'body-2': '14px',
                'label': '12px',
                'caption': '9px'
            },
            colors: {
                main: '#1C1C1C',
                primary: {
                    100: '#FFD6AA',
                    200: '#FFB566',
                    300: '#FF992C',
                    400: '#FB8200'
                },
                secondary: {
                    100: '#ACD5FF',
                    200: '#4CA6FF',
                    300: '#1A78D5',
                    400: '#004F9E'
                },
                yellow: '#FFCC00',
                red: '#FF3B30',
                green: '#34C759',
                purple: '#AF52DE',
                gray: {
                    100: '#F3F3F3',
                    200: '#EAEAEA',
                    300: '#CBCBCB',
                    400: '#B2B2B2',
                    500: '#8A8A8A',
                    600: '#505050'
                }
            },
            borderRadius: {
                '20': '20px',
                '15': '15px',
            },
            padding: {
                '12': '12px',
                '20': '20px',
                '24': '24px',
                '100': '100px'
            },
            gap: {
                '12': '12px',
                '20': '20px',
                '24': '24px'
            },
            lineHeight: {
                DEFAULT: 1
            }
        },
        container: {
            padding: {
                DEFAULT: '12px'
            },
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1440px'
            },
            center: true
        },
    },
    variants: {
        display:['group-hover']
    },

    plugins: [forms],
};
