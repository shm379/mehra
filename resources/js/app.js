import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";

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
            .use(Vue3PersianDatetimePicker, {
                name: "UiDatePicker",
                props: {
                    format: "YYYY-MM-DD HH:mm",
                    displayFormat: "jYYYY-jMM-jDD",
                    editable: false,
                    inputClass: "form-control my-custom-class-name",
                    placeholder: "Please select a date",
                    altFormat: "YYYY-MM-DD HH:mm",
                    color: "#00acc1",
                    autoSubmit: false,
                },
            })
            .use(ZiggyVue, Ziggy)
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
