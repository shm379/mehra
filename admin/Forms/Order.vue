<template>
    <form @submit.prevent="form.post('/admin/orders/'+form.id,{
      forceFormData: true,
      preserveScroll: true,
      onSuccess: () => {
          form.reset();
          if($page.props.flash.success!==null){
             $inertia.reload({ preserveState: true , preserveScroll: true })
          }
      },
  })">

        <ui-page-header title="جزئیات سفارش">
            <ui-page-header-action to="admin.orders.index"
            >مشاهده لیست سفارشات</ui-page-header-action>
        </ui-page-header>
        <ui-row>
            <ui-col wide>
                <ui-page-header-anchors v-model="sections"></ui-page-header-anchors>
            </ui-col>

        </ui-row>
        <ui-row v-for="(row,i) in sections" :key="i">
            <ui-col v-for="(item, i) in row" :wide="item.wide" :full="item.full">
                <ui-box

                    :key="i"
                    :title="item.title"
                    :id="item.anchor"
                >
                    <component :is="`ui-form-${item.anchor}`" :setting="item.props ? item.props : false" :form="form" />
                </ui-box>
            </ui-col>
        </ui-row>
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
const props = defineProps({
    form: Object
})
const {sections} = useOrder();
</script>

<style lang="scss" scoped></style>
