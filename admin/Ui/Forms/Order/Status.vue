<template>
   <div class="grid grid-cols-1 gap-4">
        <ui-input label="حمل و نقل" v-model="form.shipping_status"></ui-input>
        <ui-field-order-status v-model="form.status" />
        <ui-input readonly label="قیمت نهایی" v-model="form.total_price"></ui-input>
       <button
           type="submit"
           :disabled="form.processing || !form.isDirty"
           class="disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"
       >
           بروزرسانی
       </button>
   </div>
</template>

<script setup>
const props = defineProps({
    form: Object
})
</script>

<style scoped>

</style>
