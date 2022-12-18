import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import AutoImport from "unplugin-auto-import/vite";

const compositionResolver = (name) => {
    const isCompositionApi = name.startsWith("use");
    if (isCompositionApi) {
        return `@/Composables/${name}.js`;
    }
};

export default defineConfig({
    server: { https: false },
    plugins: [
        laravel({
            input: "admin/admin.js",
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
            "@": "/admin",
            "~": "/admin/Forms",
            module: "/admin/Modules",
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
    },
});
