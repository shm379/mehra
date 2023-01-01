<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="قیمت محصول" :errors="$page.props.errors" v-model="form.price" error="price"></ui-input>
        <ui-input type="number"  maxlength="2"  min="0" max="100" label="تخفیف" :errors="$page.props.errors" v-model="form.sale_percent"  error="sale_percent"></ui-input>
        <ui-input label="قیمت نهایی" :value="price_with_off"  disabled></ui-input>
    </div>
</template>

<script setup>


import {computed} from "vue";

const props = defineProps({
    form: Object
})
const price_with_off = computed({
    get: () => props.form.sale_percent!==0 ? props.form.price - ((props.form.price / 100) * props.form.sale_percent) : props.form.price,
});</script>

<style lang="scss" scoped>

</style>
