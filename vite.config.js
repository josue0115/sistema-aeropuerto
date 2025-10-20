import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/seat-selection.css', 'resources/css/class-selection.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
