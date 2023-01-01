<template>
    <form @submit.prevent="form.post(form.submit_url,{
      forceFormData: true,
      preserveScroll: true,
          onSuccess: () => {
              form.reset();
              if($page.props.flash.success!==null){
                 $inertia.reload({ preserveState: false , preserveScroll: true })
              }
          },
      })">
        <form-product :form="form"></form-product>
    </form>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
  layout: AdminLayout,
};
</script>

<script setup>
import {computed, ref, defineEmits, onMounted} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

const emit = defineEmits(['update:form'])
let {form} = useProduct()
const update = function (){
    let mv = form;
    mv._method = 'put';
    mv['is_update'] = true;
    mv['submit_url'] = route('admin.products.update', usePage().props.value.product.id)
    emit('update:form',form)
}
onMounted(()=>{
    update()
})
</script>

<style lang="scss" scoped></style>
