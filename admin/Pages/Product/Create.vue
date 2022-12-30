<template>
  <ui-page-header title="افزودن محصول">
    <ui-page-header-action to="admin.products.index"
      >مشاهده لیست محصولات</ui-page-header-action
    >
    <ui-page-header-action to="admin.products.create"
      >افزودن محصول جدید</ui-page-header-action
    >
  </ui-page-header>
  <ui-row>
    <ui-col>
      <ui-field-product-structure :form="form" v-model="form.structure" />
    </ui-col>
  </ui-row>
  <ui-row>
    <ui-col full>
      <ui-field-book-type :form="form" v-if="form.structure && form.structure===1" v-model="type" />
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
          <component :is="`ui-form-book-price`" :form="form" />
      </ui-box>
      <ui-box title="موجودی">
          <component :is="`ui-form-book-stock`" :form="form" />
      </ui-box>
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

const pageSections = ref([
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
        title: "ویژگی‌ها",
        anchor: "book-attributes",
    },
    {
        title: "جوایز و افتخارات",
        anchor: "book-award",
    },
    {
        title: "خلاصه",
        anchor: "book-summary",
    },
    {
        title: "نقاط قوت کتاب",
        anchor: "book-points",
    },
]);
const form = useForm({
  structure: null,
  type: {label:'کتاب چاپی',value:1},
  min_purchases_per_user: null,
  max_purchases_per_user: null,
  is_active: null,
  is_available: null,
  price: null,
  sale_percent: 0,
  title: "",
  sub_title: "",
  description: "",
  producers: [],
  authors: [],
  translators: [],
  illustrators: [],
  narrators: [],
  attributes:{},
  awards: [],
  sounds: []
});

const type = computed({
    get: () => form.type,
    set(v) {

        var mv = form;

        mv.type = v;
        // emit("update:form", mv);
        if(v===2){
            pageSections.value.push({
                title: "فایل های صوتی",
                anchor: "book-sounds",
            })
            Inertia.reload({
                preserveState:true,
            })

        } else {
            if(pageSections.value.find(section=>section.anchor==='book-sounds')){
                pageSections.value.pop()
                Inertia.reload({
                    preserveState:true
                })
            }

        }
    },
});
</script>

<style lang="scss" scoped></style>
