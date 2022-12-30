<template>
    <ui-input v-model="input" :label="attribute.title"></ui-input>
</template>

<script setup>
import {computed} from "vue"
;
const emit = defineEmits(['update:modelValue'])
const props = defineProps({ modelValue: Object, attribute: Object });
const input = computed({
    get: () => props.modelValue[props.attribute.id],
    set(v) {
        var modelValue = props.modelValue
        modelValue[props.attribute.id] = v
        emit("update:modelValue", modelValue);
    },
});

</script>
