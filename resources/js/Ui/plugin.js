import { UiRow, UiCol } from "@/Ui/js/base/grid.js";
import { UiLabel } from "@/Ui/js/base/form";
const mehraUiAdminPanelPlugin = {
    install(app, options) {
        /*
         * @Base Grid
         */
        app.component("UiRow", UiRow);
        app.component("UiCol", UiCol);

        /*
         * @Base Form
         */
        app.component("UiLabel", UiLabel);

        /*
         * =========================
         * Other Ui Components auto import
         * =========================
         */
        const components = import.meta.globEager("./Components/**/*.vue");
        Object.entries(components).forEach(([path, definition]) => {
            // Get name of component, based on filename
            // "../Forms/Name.vue" will become "UiFormName"
            // "../Forms/Nestes/Comp.vue" will become "UiFormNestedComp"
            // "../Forms/Nestes/Index.vue" will become "UiFormNested"

            const componentName =
                "Ui" +
                path
                    .split("/")
                    .splice(2)
                    .reduce(
                        (accumulator, currentValue) =>
                            accumulator + currentValue,
                        ""
                    )
                    .replace("..", "")
                    .replace("Index", "")
                    .replace(".vue", "");
            // Register component on this Vue instance
            app.component(componentName, definition.default);
        });

        /*
         * ============
         * Forms Auto import
         * ============
         */
        // load all forms from Forms Directory
        const forms = import.meta.globEager("./Forms/**/*.vue");
        Object.entries(forms).forEach(([path, definition]) => {
            // Get name of component, based on filename
            // "../Forms/Name.vue" will become "UiFormName"

            const componentName =
                "UiForm" +
                path
                    .split("/")
                    .splice(2)
                    .reduce(
                        (accumulator, currentValue) =>
                            accumulator + currentValue,
                        ""
                    )
                    .replace("..", "")
                    .replace("..", "")
                    .replace(".vue", "");

            // Register component on this Vue instance
            app.component(componentName, definition.default);
        });

        app.config.globalProperties.mehra_ui_admin_version = "0.0.1";
    },
};

export default mehraUiAdminPanelPlugin;
