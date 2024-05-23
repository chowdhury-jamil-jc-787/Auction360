import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true, // Generate manifest file for production build
        outDir: 'public/build', // Output directory for production build
        minify: 'terser', // Minify JavaScript using Terser
        cssCodeSplit: true, // Enable CSS code splitting
    },
});
