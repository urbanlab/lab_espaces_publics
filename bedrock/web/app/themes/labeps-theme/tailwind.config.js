/** @type {import('tailwindcss').Config} config */
import plugin from 'tailwindcss/plugin.js';

const config = {
  content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  safelist: [
    {
      pattern: /^has-/,
    },
  ],
  theme: {
    container: {
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '4rem',
        xl: '5rem',
        '2xl': '6rem',
      },
    },
    colors: {
      primary: '#E2092F',
      secondary: '#00A887',
      orange: '#FA743E',
      pink: '#FA3EBA',
      lightgreen: '#2EAE2B',
      blue: '#4D2BAE',
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
