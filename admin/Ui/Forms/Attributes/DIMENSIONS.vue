<template>
    <div>
        <ui-label>{{ attribute.title }}</ui-label>
        <ui-row>
            <ui-input v-if="attribute.children" v-for="(item,i) in attribute.children" v-model="input" :label="item.name"></ui-input>
        </ui-row>
    </div>
</template>

<script setup>
import { computed } from "vue"
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
