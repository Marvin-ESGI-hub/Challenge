/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors : {
        customColor : '#FF00EE',
        'primary': {
          '50': '#fffaec',
          '100': '#fff5d3',
          '200': '#ffe7a5',
          '300': '#ffd56d',
          '400': '#ffb632',
          '500': '#ff9e0a',
          '600': '#f48000',
          '700': '#cc6202',
          '800': '#a14b0b',
          '900': '#82400c',
          '950': '#461e04',
        },
      }
    },
  },
  plugins: [],
}

