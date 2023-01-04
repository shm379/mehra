<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="قیمت محصول"  v-model="form.price" error="price"></ui-input>
        <ui-input type="number"  maxlength="2"  min="0" max="100" label="تخفیف" :errors="$page.props.errors" v-model="salePercent"  error="sale_percent"></ui-input>
        <ui-input label="قیمت بدون تخفیف" v-if="salePercent<0 && props.isUpdate" v-model="form.main_price"  disabled=""></ui-input>
        <ui-input label="قیمت نهایی" :value="priceWithSale"  disabled></ui-input>
    </div>
</template>

<script setup>


import {computed} from "vue";

const props = defineProps({
    form: Object,
    isUpdate: {
        type: [Boolean],
        default: false,
    }
})
const priceWithSale = computed({
    get: () => props.form.sale_percent!==0 ? props.form.price - ((props.form.price / 100) * props.form.sale_percent) : props.form.price,
});
const salePercent = computed({
    get: () => props.form.sale_percent,
    set: (v) => v!==null && v>100 ? props.form.sale_percent = v : props.form.sale_percent = 0,
});
</script>

<style lang="scss" scoped>

</style>
