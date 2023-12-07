/** @type {import('tailwindcss').Config} config */
import plugin from 'tailwindcss/plugin.js';

const config = {
  content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  safelist: [
    {
      pattern: /^has-/,
    }
  ],
  theme: {
    colors:{
      primary: "#E2092F",
      secondary: "#00A887",
      orange: "#FA743E",
      pink: "#FA3EBA",
      lightgreen: "#2EAE2B",
      blue: "#4D2BAE",
      white: "#FFFFFF",
      black: "#000000",
    },
    fontSize:{
      xs: '14px',
      sm: '16px',
      base: '18px',
      lg: '20px',
      xl: '25px',
      '2xl': '30px',
      '3xl': '40px',
      '4xl': '60px',
    },
    extend: {
      colors: {}, // Extend Tailwind's default colors
      fontFamily: {
                sans: '"Inter var", sans-serif',
                robo: 'Roboto Regular, sans-serif',
             },
    },
  },
  plugins: [
    plugin(function ({addUtilities, theme, variants}) {
      const colors = theme('colors');
  
      const colorUtilities = Object.keys(colors).reduce((acc, color) => {
        if (typeof colors[color] === 'string') {
          acc[`.has-${color}`] = {
            'color': colors[color],
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
