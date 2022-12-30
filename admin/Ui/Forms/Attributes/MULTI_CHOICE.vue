<template>
    <div>
        <ui-autocomplete-attribute
            :api="attribute.url"
            v-model="input"
            :label="attribute.title">
                <template #tag="{ item }">
                    <span>{{ item.title }}</span>
                </template>
        </ui-autocomplete-attribute>
    </div>
</template>

<script setup>
import { computed } from "vue"
;
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    attribute: Object,
    modelValue: [Object, Array],
});
const input = computed({
    get: () => {
        return props.modelValue[props.attribute.id]
    },
    set(v) {
        var modelValue = props.modelValue
        modelValue[props.attribute.id] = v
        emit("update:modelValue", modelValue);
    },
});

</script>
