<template>
  <form enctype="multipart/form-data" @submit.prevent="form.post('/admin/stocks',{
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                if($page.props.flash.success!==null){
                   $inertia.reload({ preserveState: true , preserveScroll: true })
                }
            },
        })">
  <ui-page-header title="افزودن انبار">
    <ui-page-header-action to="admin.stocks.index"
      >مشاهده لیست انبارها</ui-page-header-action
    >
  </ui-page-header>
  <ui-row>
    <ui-col full>
      <ui-page-header-anchors v-model="sections"></ui-page-header-anchors>
    </ui-col>
  </ui-row>
  <ui-row>
    <ui-col wide>
      <ui-box
        v-for="(item, i) in sections"
        :key="i"
        :title="item.title"
        :id="item.anchor"
      >
        <form-stock
            :setting="item.props ? item.props : false"
            :form="form"
        ></form-stock>
      </ui-box>
    </ui-col>
    <ui-col>
      <ui-box title="وضعیت">
        <ui-status v-model="form.is_active"></ui-status>
        <button
          type="submit"
          :disabled="form.processing || !form.isDirty"
          class="disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"
        >
          ذخیره و دریافت موجودی
        </button>
      </ui-box>
    </ui-col>
  </ui-row>
  </form>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

const { sections, form } = useStock()
export default {
  layout: AdminLayout,
};
</script>

<script setup>
const props = defineProps({});
</script>

<style lang="scss" scoped></style>
