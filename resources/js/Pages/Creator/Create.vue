<template>
  <ui-page-header title="افزودن پدیدآورنده">
    <ui-page-header-action to="admin.creators.index"
      >مشاهده لیست پدیدآوران</ui-page-header-action
    >
    <ui-page-header-action to="admin.creators.create"
      >افزودن پدیدآور جدید</ui-page-header-action
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
        <component
          :is="`ui-form-${item.anchor}`"
          :setting="item.props ? item.props : false"
          :form="form"
        />
      </ui-box>
    </ui-col>
    <ui-col>
      <ui-box title="وضعیت">
        <Status v-model="form.status"></Status>
        <button
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
import UiPageHeader from "@/Components/Ui/Page/Header.vue";
import UiPageHeaderAction from "@/Components/Ui/Page/HeaderAction.vue";
import UiPageHeaderAnchors from "@/Components/Ui/Page/HeaderAnchors.vue";
import UiFormCreatorInfo from "@/Components/Ui/Form/Creator/Info.vue";
import UiFormCreatorAward from "@/Components/Ui/Form/Creator/Award.vue";
import UiFormCreatorGallery from "@/Components/Ui/Form/Creator/Gallery.vue";
import UiBox from "@/Components/Ui/Page/Box.vue";
import Status from "@/Components/Status.vue";

export default {
  layout: AdminLayout,
  components: {
    UiPageHeader,
    UiPageHeaderAction,
    UiPageHeaderAnchors,
    UiBox,
    Status,
    UiFormCreatorInfo,
    UiFormCreatorAward,
    UiFormCreatorGallery,
  },
};
</script>

<script setup>
const props = defineProps({
  templates: Array,
});
const pageSections = [
  {
    title: "مشخصات ",
    anchor: "creator-info",
  },
  {
    title: "تصاویر",
    anchor: "creator-gallery",
  },
  {
    title: "افزودن  جوایز و افتخارات",
    anchor: "creator-award",
  },
];
const form = useForm({
  name: "",
  first_name:"",
  last_name:"",
  slug:"",
  description:"",
  birthday:"",
  awards:[],
  types:[]
});
</script>

<style lang="scss" scoped></style>
