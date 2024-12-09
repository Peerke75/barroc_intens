import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
 
export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/map.js',
        'resources/js/leaflet.js',
        'resources/js/calendar.js',
      ],
      refresh: true,
    }),
  ],
});
