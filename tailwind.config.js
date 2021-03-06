module.exports = {
  mode: 'jit',
  purge: [
    './view/**/*.php'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('daisyui')
  ],
}
