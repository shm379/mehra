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
      <ui-box title="قیمت"> <p>content</p></ui-box>
    </ui-col>
  </ui-row>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import UiPageHeader from "@/Components/Ui/Page/Header.vue";
import UiPageHeaderAction from "@/Components/Ui/Page/HeaderAction.vue";
import UiPageHeaderAnchors from "@/Components/Ui/Page/HeaderAnchors.vue";
import UiFormProductStructure from "@/Components/Ui/Field/ProductStructure.vue";
import UiFormProductType from "@/Components/Ui/Field/ProductType.vue";
import UiFieldBookType from "@/Components/Ui/Field/BookType.vue";
import UiFormBookInfo from "@/Components/Ui/Form/BookInfo.vue";
import UiFormBookCategory from "@/Components/Ui/Form/BookCategory.vue";

import UiRow from "@/Components/Ui/Row.vue";
import UiCol from "@/Components/Ui/Col.vue";
import UiBox from "@/Components/Ui/Page/Box.vue";

export default {
  layout: AdminLayout,
  components: {
    UiPageHeader,
    UiPageHeaderAction,
    UiPageHeaderAnchors,
    UiFormProductStructure,
    UiFormProductType,
    UiFieldBookType,
    UiRow,
    UiCol,
    UiBox,
    UiFormBookInfo,
    UiFormBookCategory,
  },
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
    anchor: "attributes",
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
  producer: []
});
</script>

<style lang="scss" scoped></style>
