<template>
  <ui-page-header title="افزودن لیست">
    <ui-page-header-action to="admin.collections.index"
      >مشاهده لیست ها</ui-page-header-action>
    <ui-page-header-action to="admin.collections.create"
      >افزودن لیست جدید</ui-page-header-action>
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
        <component @update="handleUpdate"  :is="`pages-${item.anchor}`" :form="form" />
      </ui-box>
    </ui-col>
    <ui-col>
      <ui-box title="انتشار">
          <ui-status v-model="form.is_active"></ui-status>
          <button
              type="submit"
              :disabled="form.processing || !form.isDirty"
              class="disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"
          >
              انتشار
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
import {computed, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

const { sections, form } = useCollection()

const handleUpdate = function (v){
    if (sections.value.find(section => section.anchor === 'collection-components-creators')) {
        sections.value.splice(sections.value.findIndex(section => section.anchor === 'collection-components-creators'))
        Inertia.reload({
            preserveState: true
        })
    }
    if(v.collection_type===4) {
        sections.value.push({
            title: "افزودن",
            anchor: "collection-components-creators",
        })
        Inertia.reload({
            preserveState: true,
        })
    }
    if(v.collection_type===1) {
        sections.value.push({
            title: "افزودن",
            anchor: "collection-components-products",
        })
        Inertia.reload({
            preserveState: true,
        })
    }
    if(v.collection_type===3) {
        sections.value.push({
            title: "افزودن",
            anchor: "collection-components-attributes",
        })
        Inertia.reload({
            preserveState: true,
        })
    }
}
</script>

<style lang="scss" scoped></style>
