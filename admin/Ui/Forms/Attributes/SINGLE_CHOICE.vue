<template>
    <div>
        <ui-label>{{ attribute.title }}</ui-label>
        <ui-field-select :options="attribute.values" v-model="input"></ui-field-select>
    </div>
</template>

<script setup>
import { computed } from "vue"
;
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: Object,
    attribute: Object
});
const input = computed({
    get: () => props.modelValue,
    set(v) {
        var modelValue = props.modelValue
        modelValue = v
        emit("update:modelValue", modelValue);
    },
});

</script>
