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
    <ui-col wide>
      <ui-box title="مشخصات کتاب">
        <p>content</p>
      </ui-box>
      <ui-box title="طبقه بندی"> <p>content</p></ui-box>
    </ui-col>
    <ui-col>
      <ui-box title="قیمت"> <p>content</p></ui-box>
    </ui-col>
  </ui-row>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
  layout: AdminLayout,
};
</script>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import UiPageHeader from "@/Components/Ui/Page/Header.vue";
import UiPageHeaderAction from "@/Components/Ui/Page/HeaderAction.vue";
import UiFormProductStructure from "@/Components/Ui/Field/ProductStructure.vue";
import UiFormProductType from "@/Components/Ui/Field/ProductType.vue";
import UiFieldBookType from "@/Components/Ui/Field/BookType.vue";
import UiRow from "@/Components/Ui/Row.vue";
import UiCol from "@/Components/Ui/Col.vue";
import UiBox from "@/Components/Ui/Page/Box.vue";

const form = useForm({
  bookType: null,
});
</script>

<style lang="scss" scoped></style>
