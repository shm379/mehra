<template>
    <vs-popup v-bind="$attrs" :title="title" dir="rtl" v-model:active="open">
        <components-core-modal-upload-tab @select="$emit('select', $event)"  />
    </vs-popup>
</template>

<script setup>
import {useVModel} from "@vueuse/core";

const props = defineProps({
    modelValue: Object,
    title: String
})
const emit = defineEmits(['update:modelValue'])
const open = useVModel(props, "modelValue", emit)
</script>

<style lang="scss" scoped>

</style>
