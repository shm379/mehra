<template>
    <ui-field-select
        @update:modelValue="update"
        label="وضعیت"
        :options="options"
        selectLabel="وضعیت سفارش را انتخاب کنید"
        v-model="status"
        name="status"
    />
</template>

<script setup>
import {computed, ref } from "vue"
import {usePage} from "@inertiajs/inertia-vue3";

const props = defineProps({
    modelValue: Number,
});
const emit = defineEmits(['update:modelValue'])
const status = ref(props.modelValue)

const page = usePage();
const options = computed(()=> page.props.value.order_status.map((v,i) => {return {label:v, value:i}}))

function update(modelValue) {
    emit('update:modelValue', modelValue)
}


</script>

<style lang="scss" scoped>

</style>
