<template>
    <div>
        <ui-autocomplete-publisher v-model="publisher" >
        </ui-autocomplete-publisher>
    </div>
    <div>
        <ui-autocomplete-publisher v-model="publisher" >
        </ui-autocomplete-publisher>
    </div>
</template>

<script setup>
import { computed } from "vue";

import UiAutocompletePublisher from "@/Components/Ui/Autocomplete/Publisher.vue"
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({modelValue: [Object,Array]})
const publisher = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
