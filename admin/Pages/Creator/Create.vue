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

const { sections, form } = useCreator()
export default {
  layout: AdminLayout,
};
</script>

<script setup>
const props = defineProps({
  templates: Array,
});
</script>

<style lang="scss" scoped></style>
