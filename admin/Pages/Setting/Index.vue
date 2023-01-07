<template>
  <ui-page-header title="تنظیمات صفحه اصلی">
  </ui-page-header>
  <ui-row>
    <ui-col class="bg-[#3C4043] page-sidebar rounded-[15px] text-white px-[24px]">
      <ui-page-sidebar-anchors v-model="pageSections">
          <button
              type="submit"
              :disabled="form.processing || !form.isDirty"
              class="display-flex items-center justify-center w-[200px] h-12 bg-blue-300 rounded-full bg-teal-500 disabled:bg-slate-400 "
          >
              بروزرسانی
          </button>
      </ui-page-sidebar-anchors>

    </ui-col>
    <ui-col full>
      <ui-box
          class="mt-auto"
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
