<template>
    <ui-autocomplete api="/api/v1/ac/collection-types/" :label="label" v-model="collectionType" >
            <template #tag="{ item }">
                <span>{{ item.title }}</span>
            </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    modelValue: [Object, Array],
    label: {
        type: String,
        default: 'دسته بندی'
    }
})
const emit = defineEmits(["update:modelValue"]);

const collectionType = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
