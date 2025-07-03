import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0', // bind to all IPs
        port: 5173,
        strictPort: true,
        cors: {
            origin: 'http://localhost:8080', // or the specific origin of your Laravel app
            credentials: true,
        },
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        tailwindcss(),
        laravel({
            refresh: true,
        }),
    ],
});
