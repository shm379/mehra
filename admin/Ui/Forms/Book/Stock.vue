<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-field-switch label=" " trueTitle="موجود" falseTitle="ناموجود"  trueValue="1" falseValue="0" v-model="form.is_available"></ui-field-switch>
        <ui-input label="حداقل تعداد قابل خرید برای هر کاربر" class="bg-transparent border-gray-100 outline-1" type="number" :errors="error" v-model="form.min_purchases_per_user" error="min_purchases_per_user"></ui-input>
        <ui-input label="حداکثر تعداد قابل خرید برای هر کاربر" class="bg-transparent border-gray-100 outline-1" type="number" :errors="error" v-model="form.max_purchases_per_user" error="max_purchases_per_user"></ui-input>
    </div>
</template>

<script setup>


const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
