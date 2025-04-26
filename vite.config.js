import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import * as sass from 'sass'; // Importación explícita

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        'resources/sass/app.scss'
      ],
      refresh: true,
    }),
  ],
  css: {
    preprocessorOptions: {
      scss: {
        quietDeps: true, // Esto silencia los warnings

      },
    },
  },
});
