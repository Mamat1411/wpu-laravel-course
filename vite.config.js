import { defineConfig } from 'vite';
import tailwindcss from "@tailwindcss/vite";
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filepond.css',
                'resources/js/filepond.js',
                'resources/css/quill.css',
                'resources/js/quill.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
