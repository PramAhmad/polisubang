import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/css/app.css',
                // 'resources/js/app.js',
                'resources/js/page/app.js',
                'resources/js/page/role.js',
                'resources/js/page/user.js',
            ],
            refresh: true,
        }),
    ],
});
