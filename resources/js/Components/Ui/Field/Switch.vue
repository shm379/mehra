<template>
    <div class=" text-slate-500 max-w-md">
        <ui-label>{{ label || 'سوییچ' }}</ui-label>
        <div class="border border-gray-300 p-1 rounded-xl  flex flex-row justify-around">
            <button class="grow px-4 py-1 rounded-xl  duration-100" @click="toggle"
                :class="{ 'text-red-500 bg-gray-100 border border-red-500': status }">{{ trueTitle || 'فعال'
                }}</button>
            <button class="grow px-4 py-1 rounded-xl  duration-100" @click="toggle"
                :class="{ 'text-red-500 bg-gray-100 border border-red-500': !status }">{{ falseTitle || 'غیرفعال'
                }}</button>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from "vue";
import UiLabel from "@/Components/Ui/Label.vue"
const props = defineProps({
    modelValue: [String, Boolean],
    trueValue: {
        type: [String, Boolean],
        default: true,
    },
    label: String,
    trueTitle: String,
    falseTitle: String,
    falseValue: {
        type: [String, Boolean],
        default: false,
    },
})
const emit = defineEmits(['update:modelValue'])
const status = ref(props.modelValue || false)
function toggle() {
    status.value = !status.value
    emit('update:modelValue', status.value ? props.trueValue : props.falseValue)
}

</script>

<style lang="scss" scoped>

</style>
