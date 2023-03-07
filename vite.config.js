import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

// ! Uncoment when app ready to deploy, meanwhile work whit this commented, as make page reload faster
/*
import { resolve, dirname } from 'node:path'
import { fileURLToPath } from 'url'
import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'
*/
export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        /*
        VueI18nPlugin({
            include: resolve(dirname(fileURLToPath(import.meta.url)), './resources/js/Locales/**'),
        }),*/
    ],
});
