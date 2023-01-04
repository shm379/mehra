<template>
    <ui-input
        defaultClass="mb-6"
        inputType="number"
        class="bg-transparent border-gray-100 outline-1"
        v-model="input"
        :label="attribute.title">
    </ui-input>
</template>

<script setup>
import { computed } from "vue"
;
const emit = defineEmits(['update:modelValue'])
const props = defineProps({ modelValue: [Number,String], attribute: Object });
const input = computed({
    get: () => props.modelValue,
    set(v) {
        var modelValue = props.modelValue
        modelValue = v
        emit("update:modelValue", modelValue);
    },
});

</script>
