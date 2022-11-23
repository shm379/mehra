import { h, ref } from "vue";

const label = (content) => ({
    ...content,
    setup(props, { slots, emit, attrs, expose }) {
        return () => h("label", { class: "label" }, slots.default());
    },
});

export const UiLabel = label({ name: "UiLabel" });
