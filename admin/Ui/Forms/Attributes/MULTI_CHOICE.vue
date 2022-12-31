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
import {computed, onMounted} from "vue"
    ;
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    attribute: Object,
    modelValue: [Object, Array],
});
const input = computed({
    get: () => {
        return props.modelValue
    },
    set(v) {
        emit("update:modelValue", v);
    },
});

</script>
