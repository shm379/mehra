<template>
    <ui-autocomplete
        :api="props.api"
        :label="props.label"
        v-model="attribute"
        index="id"
        :multiselect="props.multiselect">
                    <template #tag="{ item }">
                        <span v-if="item">{{ item.title }}</span>
                    </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    label: String,
    api: "",
    modelValue: {
        type: [Array, Object],
        default: [],
    },
    multiselect: {
        type: Boolean,
        default: true,
    },
})
const emit = defineEmits(["update:modelValue"]);

const attribute = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
