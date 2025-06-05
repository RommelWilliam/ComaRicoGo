/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/assets/**"
  ],
  theme: {
    extend: {
      backgroundImage: {
        'login_img': "url('/public/assets/login_img.jfif')",
      },
    },
  },
  plugins: [],
}

