<template>
         <form-product  />
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
  layout: AdminLayout,
};
</script>

<script setup>
import {computed, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
const {modal} = useModal()
const props = defineProps({
    product: {
        type:[Object,Boolean],
        default:false,
    },

})
const emit = defineEmits(['update:form'])
const {prepareFormMeta,form,submitUrl,sections} = useProduct(true)
function updateForm(newForm){

    prepareFormMeta(newForm.type)
}
</script>

<style lang="scss" scoped></style>
