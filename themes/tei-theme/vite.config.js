import { defineConfig } from "vite";
import liveReload from "vite-plugin-live-reload";
import tailwindcss from "@tailwindcss/vite";
import { resolve } from "path";
import { copyFileSync, readdirSync, mkdirSync, existsSync } from "fs";

export default defineConfig({
  plugins: [
    liveReload(["**/*.php"]),
    tailwindcss(),
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

  // Explicitly set empty publicDir since we're not using HTML
  publicDir: false,

  build: {
    outDir: "assets",
    manifest: true,
    // Set empty outDir to prevent HTML expectations
    rollupOptions: {
      input: {
        main: resolve(__dirname, "src/main.js"),
        style: resolve(__dirname, "src/input.css"),
        blocks: resolve(__dirname, "src/blocks.css"),
      },
      output: {
        entryFileNames: "js/[name].js",
        chunkFileNames: "js/[name].[hash].js",
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith(".css")) {
            if (assetInfo.name === "input.css") return "css/style.css";
            if (assetInfo.name === "blocks.css") return "css/blocks.css";
            return "css/[name][extname]";
          }
          if (assetInfo.name.match(/\.(png|jpe?g|gif|svg|webp|ico)$/i)) {
            return "images/[name][extname]";
          }
          return "[name][extname]";
        },
      },
    },
    minify: process.env.NODE_ENV === "production",
  },

  server: {
    port: 3000,
    cors: {
      origin: ["http://localhost", "http://localhost/tei"],
      credentials: true,
    },
    hmr: {
      host: "localhost",
    },
    middlewareMode: false,
    headers: {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    },
  },

  resolve: {
    alias: {
      "@": resolve(__dirname, "src"),
      "@images": resolve(__dirname, "src/images"),
    },
  },

  define: {
    "process.env.NODE_ENV": JSON.stringify(
      process.env.NODE_ENV || "development"
    ),
  },
});
