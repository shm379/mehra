import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import AutoImport from "unplugin-auto-import/vite";

const compositionResolver = (name) => {
    const isCompositionApi = name.startsWith("use");
    if (isCompositionApi) {
        return `@/composables/${name}.js`;
    }
};

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
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
        AutoImport({ resolvers: [compositionResolver] }),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
            "~": "/resources/js/Forms",
            module: "/resources/js/Modules",
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
    },
});
