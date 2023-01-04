<template>
    <div class="mb-6">
        <ui-input v-model="input" :label="attribute.title"></ui-input>
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
