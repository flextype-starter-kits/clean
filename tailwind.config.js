module.exports = {
  content: ["./assets/src/**/*.{html,js,css}", "./**/*.html", "../../**/*.md", , "../../**/*.yaml", "../../**/*.yml", "../../**/*.json", "../../**/*.neon"],
  theme: {
    extend: {},
  },
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
  ]
}
