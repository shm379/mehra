<template>
    <div class="w-6.12">
        <ui-input label="حمل و نقل" v-model="form.shipping_status"></ui-input>
        <UiFormOrderStatus :form="form" v-model="form.status" />
    </div>
</template>

<script>
import UiInput from "@/Components/Ui/Field/Input.vue";
import UiFormOrderStatus from "@/Components/Ui/Field/OrderStatus.vue";
export default {
    props : {
        form: Object
    },
    components: {
        UiInput,
        UiFormOrderStatus,
    },
};
</script>

<style scoped>

</style>
