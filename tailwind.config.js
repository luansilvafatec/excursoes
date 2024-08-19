/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'cinza_cadastro': '#828282',
            },
            fontFamily: {
                'roboto': "'Roboto', sans-serif",
            },
            screens: {
                'xs': '360px',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

