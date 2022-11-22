<template>
    <div class="flex flex-row items-center justify-around space-x-2 rounded-xl bg-gray-100 p-2 duration-500 bg-red-500">
        <UiLabel class=" self-center ml-10">{{ label }}</UiLabel>
        <div v-for="(item, i) in options" :key="i" class=" grow">
            <input type="radio" name="option" :id="i" class="peer hidden" :checked="item == model"
                @change="select(i)" />
            <slot name="option" :item="item">
                <label :for="i"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:shadow-inner shadow-black  peer-checked:bg-primary-500 peer-checked:font-bold peer-checked:text-white">{{
        item
                    }}</label>
            </slot>
        </div>

    </div>
</template>

<script setup>
import { computed, ref } from "vue"
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    label: String,
    modelValue: [Number, Array, Object, String],
    options: Array
});
const model = computed({
    get: () => props.modelValue,
    set: (v) => {
        console.log(v);
        emit("update:modelValue", v);
    },
});

function select(i) {
    model.value = i
}
</script>

<style lang="scss" scoped>

</style>
