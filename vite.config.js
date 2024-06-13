import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// 追加
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        // 追加
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],

    

    server: {
        hmr: {
          host: 'https://laughing-telegram-jr45pr95r7w3jjpp-5173.app.github.dev',
        },
      },
    resolve: { 
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
