<template>
    <ui-textarea v-model="input" :label="attribute.title"></ui-textarea>
</template>

<script setup>
import { computed } from "vue"
;
const emit = defineEmits(['update:modelValue'])
const props = defineProps({ modelValue: Object, attribute: Object });
const input = computed({
    get: () => props.modelValue[props.attribute.slug],
    set(v) {
        var modelValue = props.modelValue
        modelValue[props.attribute.slug] = v
        emit("update:modelValue", modelValue);
    },
});

</script>
