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
          <ui-field-product-structure v-model="structure" />
        </ui-col>
      </ui-row>
      <ui-row>
        <ui-col full>
          <ui-field-book-type v-if="form.structure && form.structure===1" v-model="type" />
        </ui-col>
      </ui-row>
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
                  {{form.is_update===false ? 'بروزرسانی':'انتشار'}}
              </button>
          </ui-box>
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
import {computed, defineEmits, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
const { sections, form } = useProduct()

const emit = defineEmits(['update:form'])
const type = computed({
    get: () => form.type,
    set(v) {

        var mv = form;

        mv.type = v;
        // emit("update:form", mv);
        if(v===2){
            sections.value.push({
                title: "فایل های صوتی",
                anchor: "book-sounds",
            })

            Inertia.reload({
                preserveState:true,
            })

        } else {
            if(sections.value.find(section=>section.anchor==='book-sounds')){
                sections.value.splice(sections.value.findIndex(section=>section.anchor==='book-sounds'))
                Inertia.reload({
                    preserveState:true
                })
            }

        }
    },
});

const structure = computed({
    get: () => form.structure,
    set(v) {

        form.structure = v;

    },
});

</script>

<style lang="scss" scoped></style>
