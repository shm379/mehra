<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="عنوان موضوع" v-model="form.title" error="title"></ui-input>
        <ui-textarea label="توضیحات" v-model="form.description" error="description"></ui-textarea>
        <ui-field-select label="نوع موضوع" :options="collectionTypes" v-model="collection_type"></ui-field-select>
    </div>
</template>

<script setup>


import {computed, ref} from "vue";
const emit = defineEmits(['update:modelValue','update'])
const props = defineProps({
    form: Object,
    modelValue: Object,
})
const collectionTypes = ref();

loadCollectionTypes();
async function loadCollectionTypes() {
    collectionTypes.value = await fetch("/api/v1/ac/collection-types").then((response) =>
        response.json()
    );
}
const collection_type = computed({
    get: () => props.form.collection_type,
    set(v) {
        var modelValue = props.form
        modelValue.collection_type = v
        emit("update:form", modelValue);
        emit("update", modelValue)
    },
});
</script>

<style lang="scss" scoped>

</style>
