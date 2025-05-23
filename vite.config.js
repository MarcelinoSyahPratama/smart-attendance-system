import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.jsx',
            refresh: true,
        }),
        react(),
    ],
    server: {
        host: '0.0.0.0', // Listen semua IP
        port: 5173,
        hmr: {
          host: '192.168.1.2', // IP lokal kamu
        },
        cors: {
          origin: '*',
        },
      },
});
