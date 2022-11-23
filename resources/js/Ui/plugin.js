import { UiRow, UiCol } from "@/Ui/components/base/grid.js";
const mehraUiAdminPanelPlugin = {
    install(app, options) {
        /*
         * @Base Grid
         */
        app.component("UiRow", UiRow);
        app.component("UiCol", UiCol);

        app.config.globalProperties.mehra_ui_admin_version = "0.0.1";
    },
};

export default mehraUiAdminPanelPlugin;
