import "./bootstrap";
import "admin.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "./vue.m";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import mehraUiAdminPanelPlugin from "@/Ui/plugin";
const components = import.meta.globEager("./Components/*.vue");

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(mehraUiAdminPanelPlugin)
            .mount(el);
    },
});

InertiaProgress.init({
    color: "#4B5563",
    delay: 250,
    includeCSS: true,
    showSpinner: true,
});
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
