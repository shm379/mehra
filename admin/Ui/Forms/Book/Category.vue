<template>
    <div class="grid grid-cols-1 gap-8" v-if="form.structure===1">
        <ui-form-book-category-volume v-model="volume" :form="form"></ui-form-book-category-volume>
        <ui-autocomplete-publisher v-model="publisher" >
        </ui-autocomplete-publisher>
        <ui-autocomplete-creator v-model="author" label="نویسنده / نویسندگان">
        </ui-autocomplete-creator>
        <ui-autocomplete-creator v-model="illustrator" label="تصویرگر / تصویرگران">
        </ui-autocomplete-creator>
        <ui-autocomplete-creator v-model="translator" label="مترجم / مترجمین">
        </ui-autocomplete-creator>
        <ui-autocomplete-creator v-model="narrator" label="راوی / راویان">
        </ui-autocomplete-creator>
    </div>
    <div class="grid grid-cols-1 gap-8">
        <ui-autocomplete-category v-model="category" >
        </ui-autocomplete-category>
    </div>
</template>

<script setup>
import { computed } from "vue";

const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object
})
const volume = computed({
    get: () => props.form.volumes,
    set(v) {
        var mv = props.form
        mv.volume = v
        emit("update:form", mv);
    },
});
const publisher = computed({
    get: () => props.form.producers,
    set(v) {
        var mv = props.form
        mv.publisher = v
        emit("update:form", mv);
    },
});
const author = computed({
    get: () => props.form.authors,
    set(v) {
        var mv = props.form
        mv.author = v
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
const illustrator = computed({
    get: () => props.form.illustrators,
    set(v) {
        var mv = props.form
        mv.creators = v
        emit("update:form", mv);
    },
});
const translator = computed({
    get: () => props.form.translators,
    set(v) {
        var mv = props.form
        mv.creators = v
        emit("update:form", mv);
    },
});
const narrator = computed({
    get: () => props.form.narrators,
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
