<template>
    <div class="w-6.12">
        <ui-input label="حمل و نقل" v-model="form.shipping_status"></ui-input>
        <ui-field-order-status :form="form" v-model="form.status" />
    </div>
</template>

<script>

export default {
    props : {
        form: Object
    },

};
</script>

<style scoped>

</style>
