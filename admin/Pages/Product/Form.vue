<template>
    <form @submit.prevent="form.post(submitUrl,{
      forceFormData: true,
      preserveScroll: true,
          onSuccess: () => {
              form.reset();
              if($page.props.flash.success!==null){
                 $inertia.reload({ preserveState: true , preserveScroll: true })
              }
          },
      })">
         <form-product :form="form"></form-product>

    </form>
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
const {form,submitUrl} = useProduct(true)

</script>

<style lang="scss" scoped></style>
