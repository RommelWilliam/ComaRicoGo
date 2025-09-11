/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      backgroundImage: {
        'login_img': "url('/public/assets/login_img.jfif')",
        'login_negocio_img': "url('/public/assets/login_negocio.jpg')",
      }
    },
  },
  plugins: [],
}
