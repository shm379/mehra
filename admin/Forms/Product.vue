<template>
    <form @submit.prevent="form.post(submitUrl,{
      forceFormData: true,
      preserveScroll: true,
          onSuccess: () => {
              form.reset();
              if($page.props.flash.success!==null){
                 $inertia.reload({ preserveState: true , preserveScroll: true })
              }
          },
      })">
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
          <ui-page-header-anchors  v-model="sections"></ui-page-header-anchors>
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
    </form>
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
const { sections,isUpdate, form, submitUrl, prepareFormMeta } = useProduct(true)

const emit = defineEmits(['update:form'])
const type = computed({
    get: () => form.type,
    set(v) {
        var mv = form;
        mv.type = v;
        prepareFormMeta()
    },
});

const structure = computed({
    get: () => form.structure,
    set(v) {
      let vm = form;
      vm.structure = v
      emit('update:form',vm)

    },
});

</script>

<style lang="scss" scoped></style>
