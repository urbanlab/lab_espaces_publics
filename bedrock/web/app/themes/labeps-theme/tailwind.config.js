/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    extend: {
      colors: {}, // Extend Tailwind's default colors
      fontFamily: {
                sans: 'Roboto Regular, sans-serif',
             },
    },
  },
  plugins: [],
};

export default config;
