<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-autocomplete-collection label="لیست های منتخب قالب انتخاب شده" v-model="form.template_setting" :multiselect="false">
        </ui-autocomplete-collection>
    </div>
</template>

<script setup>
import { computed } from "vue";

import UiAutocompleteCollection from "@/Components/Ui/Autocomplete/Collection.vue";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object,
});

const category = computed({
    get: () => props.form.categories,
    set(v) {
        var mv = props.form;
        mv.categories = v;
        emit("update:form", mv);
    },
});
</script>
