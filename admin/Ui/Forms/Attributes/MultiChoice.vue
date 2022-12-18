<template>
    <div>
        <ui-label>{{ attribute.name }}</ui-label>
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
        emit("update:modelValue", v);
    },
});

</script>
