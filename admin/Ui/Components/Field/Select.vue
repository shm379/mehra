<template>
        <ui-label>{{ label }}</ui-label>
    <select :id="name" @change="update" v-model="select"
        class="block pr-10 mb-6 w-full text-lg  text-gray-900 bg-gray-100 rounded-xl border-0 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
        <option :value="item.value" v-for="item,i in options" :key="i">{{ item.label }}</option>
    </select>
    {{  }}
</template>

<script setup>
import {ref} from "vue";
const emit=defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: String,
    name: {
        type: String,
        default: 'form-select'
    },
    options: {
        type: Array,
        default: []
    },
    label: String,
})
const select = ref()
function update() {
    emit('update:modelValue', select.value)
}
</script>

<style lang="scss" scoped>

</style>
