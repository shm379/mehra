<template>
    <ui-field-select
        @update:modelValue="update"
        label="انتخاب ساختار"
        :options="structures"
        selectLabel="ساختار محصول را انتخاب کنید"
        v-model="structure"
        name="structure"
    />
</template>

<script setup>
import {computed, ref} from "vue"
import {Inertia} from "@inertiajs/inertia";

const structures = ref();

async function loadStructures() {
    structures.value = await fetch("/api/v1/ac/product-structures").then((response) =>
        response.json()
    );
}

loadStructures();


const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: Number,
})
const structure = ref(1)
function update(modelValue) {
    emit('update:modelValue', modelValue)
}

</script>

<style lang="scss" scoped>

</style>
