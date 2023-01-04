<template>
    <div>
        <ui-label>{{ attribute.title }}</ui-label>
        <ui-input
            class="bg-transparent border-gray-100 outline-1"
            v-model="input"></ui-input>
    </div>
</template>

<script setup>
import { computed } from "vue"
;
const emit = defineEmits(['update:modelValue'])
const props = defineProps({ modelValue: Object, attribute: Object });
const input = computed({
    get: () => props.modelValue,
    set(v) {
        var modelValue = props.modelValue
        modelValue = v
        emit("update:modelValue", modelValue);
    },
});

</script>
