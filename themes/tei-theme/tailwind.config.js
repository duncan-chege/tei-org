// This config is only for VS Code IntelliSense
// Actual theming is done in src/input.css with @theme

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./**/*.php",
    "./src/**/*.{js,css}",
    "./templates/**/*.php",
    "./*.php",
  ],
  safelist: [
    {
      pattern: /^(wp-block.*|align.*|has-.*|gallery.*|wp-element.*)$/,
    },
  ],
};
