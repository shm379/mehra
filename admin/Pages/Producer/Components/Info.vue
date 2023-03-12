<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="عنوان" v-model="form.title" error="title"></ui-input>
        <ui-input label="عنوان فرعی" v-model="form.sub_title" error="sub_title"></ui-input>
        <ui-textarea label="توضیحات" v-model="form.description" error="description"></ui-textarea>
        <ui-field-select label="نوع" :options="producerTypes" v-model="producer_type"></ui-field-select>
    </div>
</template>

<script setup>


import {computed, ref} from "vue";
const emit = defineEmits(['update:modelValue','update'])
const props = defineProps({
    form: Object,
    modelValue: Object,
})
const producerTypes = ref();

loadProducerTypes();
async function loadProducerTypes() {
    producerTypes.value = await fetch("/api/v1/ac/producer-types").then((response) =>
        response.json()
    );
}
const producer_type = computed({
    get: () => props.form.producer_type,
    set(v) {
        var modelValue = props.form
        modelValue.producer_type = v
        emit("update:form", modelValue);
        emit("update", modelValue)
    },
});
</script>

<style lang="scss" scoped>

</style>
