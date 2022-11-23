import { h, ref, computed } from "vue";

/*
 * UiLabel
 */
const label = (content) => ({
    ...content,
    setup(props, { slots, emit, attrs, expose }) {
        return () => h("label", { class: "label" }, slots.default());
    },
});

export const UiLabel = label({ name: "UiLabel" });

/*
 * UiInput
 */
const input = (content) => ({
    ...content,
    props: {
        modelValue: String,
        label: String,
        error: String,
        errors: [Array, Object, Boolean],
    },
    setup(props, { slots, emit, attrs, expose }) {
        const errorElement =
            props.errors && props.errors[props.error]
                ? h(
                      "div",
                      { class: "caption-error" },
                      props.errors[props.error]
                  )
                : "";
        return () =>
            h([
                h(
                    "div",
                    { class: "input-wrapper" },
                    h([
                        h("ui-label", { class: "label" }, props.label),
                        h("input", {
                            class: {
                                input: true,
                                "border-red-500 border bg-red-50":
                                    props.errors && props.errors[error],
                            },
                            modelValue: props.modelValue,
                            "onUpdate:modelValue": (value) =>
                                emit("update:modelValue", value),
                        }),
                        errorElement,
                    ])
                ),
            ]);
    },
});
export const UiInput = input({ name: "UiInput" });
