<template>
  <ui-page-header title="تنظیمات صفحه اصلی">
  </ui-page-header>
  <ui-row>
    <ui-col>
      <ui-page-sidebar-anchors v-model="pageSections"></ui-page-sidebar-anchors>
      <button
          type="submit"
          :disabled="form.processing || !form.isDirty"
          class="disabled:bg-slate-400 fixed bottom-[120px] p-20 space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"
      >
        بروزرسانی
      </button>
    </ui-col>
    <ui-col full>
      <ui-box
          v-for="(item, i) in pageSections"
          :key="i"
          :title="item.title"
          :id="item.anchor"
      >
        <component :is="`ui-form-${item.anchor}`" :form="form" />
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
import {useForm} from "@inertiajs/inertia-vue3";

const pageSections = [
  {
    title: "اسلایدر",
    anchor: "settings-HomePageSlider",
  },
  {
    title: "فروش ویژه",
    anchor: "settings-HomePageSale",
  },
  {
    title: "دسته بندی ها",
    anchor: "settings-HomePageCategories",
  },
  {
    title: "لیست ها",
    anchor: "settings-HomePageCollections",
  },
  {
    title: "بنرها",
    anchor: "settings-HomePageAnnouncements",
  },
  {
    title: "اخبار و مقالات منتخب",
    anchor: "settings-HomePageBlog",
  },
];
const props = defineProps({
  settings: Array,
});
const form = useForm({
  sliders: [],
  sale: [],
  collections: [],
  announcements: [],
  blogs: []
});
</script>

<style lang="scss" scoped></style>