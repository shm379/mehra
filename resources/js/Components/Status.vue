<template>
    <div class="pt-5 text-slate-500">
        <label class="text-sm text-slate-600 mb-3 block">وضعیت</label>
        <div class="border border-gray-300 p-1 rounded-lg flex flex-row justify-around">
            <button class="grow px-4 py-1 rounded-xl  duration-100" @click="toggle" :class="{ 'text-red-300 bg-red-100/50 border border-red-500': status }">فعال</button>
            <button class="grow px-4 py-1 rounded-xl  duration-100" @click="toggle" :class="{ 'text-red-300 bg-red-100/50 border border-red-500': !status }">غیرفعال</button>
        </div>
    </div>
</template>

<script setup>
import {ref, defineProps, defineEmits } from "vue";
const props=defineProps({
    modelValue: Boolean
})
const emit = defineEmits(['update:modelValue'])
const status = ref(props.modelValue || false)
function toggle() {
    status.value = !status.value
    emit('update:modelValue', status.value)
}

</script>

<style lang="scss" scoped>

</style>
