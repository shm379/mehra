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
      <ui-box
        v-for="(item, i) in pageSections"
        :key="i"
        :title="item.title"
        :id="item.anchor"
      >
        <component :is="`ui-form-${item.anchor}`" :setting="item.props ? item.props : false" :form="form" />
      </ui-box>
    </ui-col>
    <ui-col>
      <ui-box title="وضعیت"> <Status v-model="form.status"></Status></ui-box>
    </ui-col>
  </ui-row>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import UiPageHeader from "@/Components/Ui/Page/Header.vue";
import UiPageHeaderAction from "@/Components/Ui/Page/HeaderAction.vue";
import UiPageHeaderAnchors from "@/Components/Ui/Page/HeaderAnchors.vue";
import UiFormCategoryInfo from "@/Components/Ui/Form/CategoryInfo.vue";
import UiFormCategoryGallery from "@/Components/Ui/Form/CategoryGallery.vue";
import UiFormCategoryCategory from "@/Components/Ui/Form/CategoryCategory.vue";
import UiFormCategoryTemplate from "@/Components/Ui/Form/CategoryTemplate.vue";
import UiFormCategoryTemplateSetting from "@/Components/Ui/Form/CategoryTemplateSetting.vue";
import UiBox from "@/Components/Ui/Page/Box.vue";
import Status from "@/Components/Status.vue"

export default {
  layout: AdminLayout,
  components: {
    UiPageHeader,
    UiPageHeaderAction,
    UiPageHeaderAnchors,
    UiBox,
    UiFormCategoryInfo,
    UiFormCategoryCategory,
    UiFormCategoryGallery,
    UiFormCategoryTemplate,
    UiFormCategoryTemplateSetting,
    Status
  },
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
  gallery: [],
  template: null,
  template_setting: [],
});
</script>

<style lang="scss" scoped></style>
