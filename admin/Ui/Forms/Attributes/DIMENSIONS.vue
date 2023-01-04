<template>
    <div class="mb-6">
        <ui-label>{{ attribute.title }}</ui-label>
        <ui-row>
            <ui-input
                v-if="attribute.children"
                v-for="(item,i) in attribute.children"
                :key="i"
                v-model="input[item.id]"
                :label="item.name"
            ></ui-input>
        </ui-row>
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
