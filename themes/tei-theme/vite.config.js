import { defineConfig } from "vite";
import liveReload from "vite-plugin-live-reload";
import tailwindcss from "@tailwindcss/vite";
import { resolve } from "path";
import { copyFileSync, readdirSync, mkdirSync, existsSync } from "fs";

export default defineConfig({
  plugins: [
    liveReload([
      // Watch PHP files for changes
      "**/*.php",
    ]),
    tailwindcss(),
    // Custom plugin to copy all images
    {
      name: "copy-images",
      writeBundle() {
        const srcImagesDir = resolve(__dirname, "src/images");
        const destImagesDir = resolve(__dirname, "assets/images");

        if (existsSync(srcImagesDir)) {
          if (!existsSync(destImagesDir)) {
            mkdirSync(destImagesDir, { recursive: true });
          }

          const files = readdirSync(srcImagesDir);
          files.forEach((file) => {
            if (file.match(/\.(png|jpe?g|gif|svg|webp|ico)$/i)) {
              copyFileSync(
                resolve(srcImagesDir, file),
                resolve(destImagesDir, file)
              );
            }
          });
        }
      },
    },
  ],

  // CSS processing
  css: {
    postcss: {},
  },

  // This makes Vite serve files from src/ as static assets
  publicDir: "src",

  // Build configuration
  build: {
    // Output directory relative to project root
    outDir: "assets",

    // Generate manifest for WordPress integration
    manifest: true,

    rollupOptions: {
      input: {
        main: "src/main.js",
        style: "src/input.css",
      },
      output: {
        // Keep original filenames for easier WordPress integration
        entryFileNames: "js/[name].js",
        chunkFileNames: "js/[name].js",
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith(".css")) {
            // CSS files go to css/style.css
            return "css/style[extname]";
          }
          if (assetInfo.name.match(/\.(png|jpe?g|gif|svg|webp|ico)$/i)) {
            // Images go to images/ folder
            return "images/[name][extname]";
          }
          // Other assets (fonts, etc.) go to root of assets folder
          return "[name][extname]";
        },
      },
    },

    // Don't minify in development
    minify: process.env.NODE_ENV === "production",
  },

  // Development server configuration
  server: {
    // Set custom port
    port: 3000,

    // Enable CORS for WordPress integration
    cors: {
      origin: ["http://localhost", "http://localhost/tei"],
      credentials: true,
    },

    // Hot reload configuration
    hmr: {
      host: "localhost",
    },

    // Don't try to serve a full website - just assets
    middlewareMode: false,

    // Configure headers for CORS
    headers: {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    },
  },

  // Define path aliases for easier imports
  resolve: {
    alias: {
      "@": resolve(__dirname, "src"),
      "@images": resolve(__dirname, "src/images"),
    },
  },

  // Define global constants
  define: {
    "process.env.NODE_ENV": JSON.stringify(
      process.env.NODE_ENV || "development"
    ),
  },
});
