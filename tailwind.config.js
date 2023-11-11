/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,php,js}"],
  theme: {
    extend: {
      height: {
        '128': '32rem',
      },
      width: {
        '104': '28rem',
      }
    },
  },
  plugins: [],
}

