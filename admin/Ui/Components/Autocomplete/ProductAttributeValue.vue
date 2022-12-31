<template>
    <ui-autocomplete :api="'/api/v1/ac/attributeValues/'" :label="label" v-model="product" >
                    <template #tag="{ item }">
                        <span>{{ item.title }}</span>
                    </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({ modelValue: [Object, Array], label: {
    type: String,
    default: 'محصول / محصولات'
} })
const emit = defineEmits(["update:modelValue"]);

const product = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
