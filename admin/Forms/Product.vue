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
          <ui-field-product-structure :options="$page.props.structures" v-model="structure" />
        </ui-col>
      </ui-row>
      <ui-row class="mb-5">
        <ui-col full>
          <ui-field-book-type :options="$page.props.types" v-if="form.structure && form.structure===1" v-model="type" />
        </ui-col>
      </ui-row>
      <ui-row class="sticky top-0 bg-white z-10 ">
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
            <component :is="`components-${item.anchor}`" :form="form" />
          </ui-box>
        </ui-col>
        <ui-col class="sticky top-10 bg-white ">
          <ui-box title="قیمت">
              <component :is="`components-product-form-price`" :isUpdate="isUpdate" :form="form" />
          </ui-box>
          <ui-box title="موجودی">
              <component :is="`components-product-form-stock`" :form="form" />
          </ui-box>
          <ui-box title="انتشار">
              <ui-status v-model="form.is_active"></ui-status>
              <button
                  type="submit"
                  :disabled="form.processing || !form.isDirty"
                  class="disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"
              >
                  {{isUpdate ? 'بروزرسانی':'انتشار'}}
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
const { sections,isUpdate } = useProduct()
const props = defineProps({
    form:Object,
    media:Array
})
const emit = defineEmits(['update:form'])
const type = computed({
    get: () => props.form.type,
    set(v) {

        var mv = props.form;

        mv.type = v;
        // emit("update:form", mv);
        if(v!==2) {
            if(sections.value.find(section=>section.anchor==='book-form-sounds')){
              mv.is_virtual = false;
                sections.value.splice(sections.value.findIndex(section=>section.anchor==='book-form-sounds'))
            }
        }
        Inertia.reload({
            preserveState:true
        })
    },
});

const structure = computed({
    get: () => props.form.structure,
    set(v) {
      let vm = props.form;
      vm.structure = v
      if(v===1){

      }
      emit('update:form',vm)

    },
});

</script>

<style lang="scss" scoped></style>
