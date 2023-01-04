<template>
    <ui-field-select
        @update:modelValue="update"
        label="انتخاب ساختار"
        :options="options"
        selectLabel="ساختار محصول را انتخاب کنید"
        v-model="structure"
        name="structure"
    />
</template>

<script setup>
import {computed, ref} from "vue"
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-vue3";
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: Number,
    options: Object,
})
const structure = ref(1)
function update(modelValue) {
    emit('update:modelValue', modelValue)
}

</script>

<style lang="scss" scoped>

</style>
