<template>
    <ui-autocomplete api="/api/v1/ac/cities/" :label="label" v-model="city" :multiselect="false">
            <template #tag="{ item }">
                <span>{{ item.title }}</span>
            </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({ modelValue: [Object, Array], label: {
    type: String,
    default: 'شهر'
} })
const emit = defineEmits(["update:modelValue"]);

const city = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
