import { h, ref } from "vue";

const row = (content) => ({
    ...content,
    props: {
        name: {
            type: String,
            required: true,
        },
        hidden: Boolean,
    },
    setup(props, { slots, emit, attrs, expose }) {
        return () =>
            h(
                "div",
                { class: "flex flex-row gap-4 justify-start items-start" },
                slots.default()
            );
    },
});

const col = (content) => ({
    ...content,
    props: {
        wide: {
            type: Boolean,
            default: false,
        },
        full: {
            type: Boolean,
            default: false,
        },
    },
    setup(props, { slots, emit, attrs, expose }) {
        return () =>
            h(
                "div",
                {
                    class: {
                        "w-1/3": !wide && !full,
                        "w-2/3": wide,
                        "w-full": full,
                    },
                },
                slots.default()
            );
    },
});

export const UiRow = row({ name: "UiRow" });
export const UiCol = row({ name: "UiCol" });
