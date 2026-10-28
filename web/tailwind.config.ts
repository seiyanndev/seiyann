import type { Config } from "tailwindcss";

// Same config the WordPress theme gave the Tailwind Play CDN in header.php, now compiled at build time.
const config: Config = {
  content: ["./app/**/*.{ts,tsx}", "./components/**/*.{ts,tsx}", "./content/**/*.ts"],
  darkMode: "class",
  theme: {
    extend: {
      // Montserrat everywhere (loaded in app/layout.tsx); system fonts only as a fallback
      fontFamily: {
        sans: ["Montserrat", "ui-sans-serif", "system-ui", "sans-serif"],
      },
    },
  },
  plugins: [],
};

export default config;
