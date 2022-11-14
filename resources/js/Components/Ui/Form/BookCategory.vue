<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-autocomplete-publisher v-model="publisher" >
        </ui-autocomplete-publisher>
        <ui-autocomplete-creator v-model="creator" >
        </ui-autocomplete-creator>
        <ui-autocomplete-category v-model="category" >
        </ui-autocomplete-category>
    </div>
</template>

<script setup>
import { computed } from "vue";

import UiAutocompletePublisher from "@/Components/Ui/Autocomplete/Publisher.vue"
import UiAutocompleteCreator from "@/Components/Ui/Autocomplete/Creator.vue"
import UiAutocompleteCategory from "@/Components/Ui/Autocomplete/Category.vue"
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object
})
const publisher = computed({
    get: () => props.form.producers,
    set(v) {
        var mv = props.form
        mv.publisher = v
        emit("update:form", mv);
    },
});
const creator = computed({
    get: () => props.form.creators,
    set(v) {
        var mv = props.form
        mv.creators = v
        emit("update:form", mv);
    },
});
const category = computed({
    get: () => props.form.categories,
    set(v) {
        var mv = props.form
        mv.categories = v
        emit("update:form", mv);
    },
});
</script>

<style lang="scss" scoped>

</style>
