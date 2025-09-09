import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/guest/main.css',
                'resources/css/guest/login.css',
                
                'resources/js/guest/main.js',
                'resources/js/guest/login.css',
                
                
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
