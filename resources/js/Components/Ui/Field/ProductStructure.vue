<template>
    <ui-field-select @update:modelValue="update" label="انتخاب ساختار" :options="options" selectLabel="ساختار محصول را انتخاب کنید" v-model="structure"  />
</template>

<script setup>
import {ref} from "vue"
import UiFieldSelect from "@/Components/Ui/Field/Select.vue"
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: Object
})
const options = ref([
    {label: 'کتاب', value: 'book'},
    {label: 'لوازم التحریر', value: 'tools'},
    {label: 'خنزل پنزل', value: 'craft'},
])
const structure = ref({ label: 'کتاب', value: 'book' });
function update() {
    emit('update:modelValue', structure.value)
}

</script>

<style lang="scss" scoped>

</style>
