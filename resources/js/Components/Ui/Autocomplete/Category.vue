<template>
    <ui-autocomplete api="/api/v1/ac/categories/" label="دسته بندی" v-model="creator" >
                    <template #tag="{ item }">
                        <span>{{ item.title }}</span>
                    </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

import UiAutocomplete from "@/Components/Ui/Autocomplete/Index.vue"
const props = defineProps({ modelValue: [Object, Array] })
const emit = defineEmits(["update:modelValue"]);

const creator = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
