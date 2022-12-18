<template>
    <ui-field-select label="وضعیت" :options="options" selectLabel="وضعیت سفارش را انتخاب کنید" v-model="form.status"  />
    {{options}}
</template>

<script setup>
import {computed, ref } from "vue"
import {usePage} from "@inertiajs/inertia-vue3";

const props = defineProps({
    form: Object,
});

const page = usePage();
const options = computed(()=> page.props.value.order_status.map((v,i) => {return {label:v, value:i}}))


</script>

<style lang="scss" scoped>

</style>
