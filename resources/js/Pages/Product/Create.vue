<template>
  <ui-page-header title="افزودن محصول">
    <ui-page-header-action to="admin.products.index"
      >مشاهده لیست محصولات</ui-page-header-action
    >
    <ui-page-header-action to="admin.products.index"
      >افزودن محصول جدید</ui-page-header-action
    >
  </ui-page-header>
  <ui-row>
    <ui-col>
      <UiFormProductStructure />
    </ui-col>
    <ui-col wide>
      <UiFormProductType />
    </ui-col>
  </ui-row>
  <ui-row>
    <ui-col full>
      <ui-field-book-type v-model="form.bookType" />
      {{ form.bookType }}
    </ui-col>
  </ui-row>
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
        <component :is="`ui-form-${item.anchor}`" :form="form" />
      </ui-box>
    </ui-col>
    <ui-col>
      <ui-box title="قیمت">
        <p></p
      ></ui-box>
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
const pageSections = [
  {
    title: "مشخصات کتاب",
    anchor: "book-info",
  },
  {
    title: "طبقه بندی",
    anchor: "book-category",
  },
  {
    title: "تصاویر",
    anchor: "book-gallery",
  },
  {
    title: "ویژگیها",
    anchor: "book-attribute",
  },
  {
    title: "جوایز و افتخارات",
    anchor: "book-award",
  },
  {
    title: "خلاصه",
    anchor: "book-summary",
  },
];
const form = useForm({
  bookType: null,
  title: "",
  sub_title: "",
  description: "",
  producers: [],
  creators: [],
  translators: [],
  illustrators: [],
  narrators: [],
  attributes:{},
  awards: []
});
</script>

<style lang="scss" scoped></style>
