import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // Mode sombre désactivé tant qu'aucune classe "dark" n'est posée : la maquette est en thème clair.
    darkMode: 'class',

    theme: {
        extend: {
            // Couleurs de la maquette (thème « atelier bois »)
            colors: {
                cream: '#F4ECDD',
                pine: {
                    DEFAULT: '#1F4A3A',
                    light: '#2C6450',
                },
                bark: '#2E2118',
            },
            // Polices de la maquette : Fraunces pour les titres, DM Sans pour le texte
            fontFamily: {
                sans: ['"DM Sans"', ...defaultTheme.fontFamily.sans],
                serif: ['Fraunces', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
