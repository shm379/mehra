<template>
    <ui-autocomplete api="/api/v1/ac/awards/" label="جوایز" v-model="publisher" >
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

const publisher = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
