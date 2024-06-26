/** @type {import('tailwindcss').Config} config */
import plugin from 'tailwindcss/plugin.js';
import flowbite from 'flowbite/plugin.js';

const config = {
  content: [
    './index.php',
    './app/**/*.php',
    './resources/**/*.{php,vue,js}',
    './node_modules/flowbite/**/*.js',
  ],
  safelist: [
    {
      pattern: /^has-/,
    },
  ],
  important: true,
  theme: {
    container: {
      padding: {
        DEFAULT: '1rem',
        sm: '4rem',
        lg: '6rem',
        xl: '7rem',
        '2xl': '8rem',
      },
    },
    colors: {
      primary: '#E2092F',
      secondary: '#158579',
      orange: '#FA743E',
      pink: '#FA3EBA',
      lightgreen: '#2EAE2B',
      purple: '#4D2BAE',
      grey: '#989898',
      white: '#FFFFFF',
      black: '#000000',
    },
    fontSize: {
      xs: '0.875rem',
      sm: '1rem',
      base: '1.25rem',
      lg: '1.563rem',
      xl: '1.875rem',
      '2xl': '2.5rem',
      '3xl': '3.75rem',
    },
    fontFamily: {
      sans: 'Inter var, sans-serif',
      mono: 'Roboto Regular, sans-serif',
    },
    extend: {
      colors: {}, // Extend Tailwind's default colors
    },
  },
  plugins: [
    flowbite,
    plugin(function ({addUtilities, theme, variants}) {
      const colors = theme('colors');

      const colorUtilities = Object.keys(colors).reduce((acc, color) => {
        if (typeof colors[color] === 'string') {
          acc[`.has-${color}`] = {
            color: colors[color],
          };
          acc[`.has-${color}-background-color`] = {
            'background-color': colors[color],
          };
        } else {
          Object.keys(colors[color]).forEach((shade) => {
            acc[`.has-${color}-${shade}-background-color`] = {
              'background-color': colors[color][shade],
            };
          });
        }

        return acc;
      }, {});

      addUtilities(colorUtilities, variants('backgroundColor'));
    }),
  ],
};

export default config;
