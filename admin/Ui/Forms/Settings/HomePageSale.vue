<template>
    <div class=" bg-white rounded-[15px] p-6 grid grid-cols-1 gap-8">
        <p>انتخاب حداقل ۱۰ و حداکثر ۲۰ محصول ویژه</p>
        <ui-autocomplete-product v-model="product" >
        </ui-autocomplete-product>
    </div>
</template>

<script setup>
import {computed} from "vue";

const product = computed({
    get: () => props.form.products,
    set(v) {
        var mv = props.form
        mv.product = v
        emit("update:form", mv);
    },
});
const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
