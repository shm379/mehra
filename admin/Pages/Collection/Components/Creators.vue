<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-autocomplete-creator v-model="author" label="نویسنده / نویسندگان">
        </ui-autocomplete-creator>
        <ui-autocomplete-creator v-model="illustrator" label="تصویرگر / تصویرگران">
        </ui-autocomplete-creator>
        <ui-autocomplete-creator v-model="translator" label="مترجم / مترجمین">
        </ui-autocomplete-creator>
        <ui-autocomplete-creator v-model="narrator" label="راوی / راویان">
        </ui-autocomplete-creator>
    </div>
</template>

<script setup>
import {computed, onMounted} from "vue";

onMounted(()=>{
    props.form.items = {
        authors: [],
        illustrators: [],
        narrators: [],
        translators: [],
    }
})
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object
})
const author = computed({
    get: () => props.form.items.authors,
    set(v) {
        var mv = props.form
        mv.items.authors = v
        emit("update:form", mv);
    },
});
const illustrator = computed({
    get: () => props.form.items.illustrators,
    set(v) {
        var mv = props.form
        mv.items.illustrators = v
        emit("update:form", mv);
    },
});
const translator = computed({
    get: () => props.form.items.translators,
    set(v) {
        var mv = props.form
        mv.items.translators = v
        emit("update:form", mv);
    },
});
const narrator = computed({
    get: () => props.form.items.narrators,
    set(v) {
        var mv = props.form
        mv.items.narrators = v
        emit("update:form", mv);
    },
});
</script>

<style lang="scss" scoped>

</style>
