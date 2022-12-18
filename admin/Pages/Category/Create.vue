<template>
  <ui-page-header title="افزودن دسته بندی">
    <ui-page-header-action to="admin.products.index"
      >مشاهده لیست دسته‌ها</ui-page-header-action
    >
    <ui-page-header-action to="admin.products.index"
      >افزودن دسته‌بندی جدید</ui-page-header-action
    >
  </ui-page-header>
  <ui-row>
    <ui-col full>
      <ui-page-header-anchors v-model="pageSections"></ui-page-header-anchors>
    </ui-col>
  </ui-row>
  <ui-row>
    <ui-col wide>
      <div
          v-if="$page.props.flash.error"
          class="text-red-500 border-red-500 bg-red-50 border p-5 rounded-lg mb-10 duration-1000"
      >
        {{ $page.props.flash.error }}
      </div>
      <div
          v-if="$page.props.flash.success"
          class="text-emerald-500 border-green-500 bg-emerald-50 border p-5 rounded-lg mb-10 duration-1000"
      >
        {{ $page.props.flash.success }}
      </div>
      <ui-box
        v-for="(item, i) in pageSections"
        :key="i"
        :title="item.title"
        :id="item.anchor"
      >
        <component :is="`ui-form-${item.anchor}`"
                   :setting="item.props ? item.props : false"
                   :form="form"
        />
      </ui-box>
    </ui-col>
    <ui-col>
      <ui-box title="وضعیت">
        <UiStatus v-model="form.status"></UiStatus>
        <button
            @click.prevent="form.post('/admin/categories',{
                    forceFormData: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        form.reset();
                        if($page.props.flash.success!==null){
                           $inertia.reload({ preserveState: true , preserveScroll: true })
                        }
                    },
            })"
            type="submit"
            :disabled="form.processing || !form.isDirty"
            class="disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"
        >
          ذخیره
        </button>
      </ui-box>
    </ui-col>
  </ui-row>
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
    templates: Array
})
const pageSections = [
  {
    title: "مشخصات ",
    anchor: "category-info",
  },
  {
    title: "طبقه بندی",
      anchor: "category-category",
  },
  {
    title: "تصاویر",
    anchor: "category-gallery",
  },
  {
    title: "قالب",
    anchor: "category-template",
    props: props.templates
  },
  {
    title: "تنظیمات قالب",
    anchor: "category-template-setting",
  },
];
const form = useForm({
  title: "",
  slug: "",
  description: "",
  parent: null,
  parent_id: null,
  gallery: [],
  category_template_id: null,
  template: null,
  template_setting: [],
});
form.category_template_id = 1;
</script>

<style lang="scss" scoped></style>
