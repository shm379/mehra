<template>
  <div class="grid grid-cols-1 gap-8">
    <ui-input label="عنوان" :errors="error" v-model="form.title" error="title"></ui-input>
    <ui-input
      label="نام انگلیسی"
      :errors="error"
      v-model="form.en_name"
      error="en_name"
    ></ui-input>
    <ui-input
      label="اسم کوتاه"
      :errors="error"
      v-model="form.slug"
      error="slug"
    ></ui-input>
    <ui-input label="عنوان" :errors="error" v-model="form.title" error="type"></ui-input>
    <UiSelectGroup label="نوع ویژگی" v-model="form.type"  :options="options" >
        <template v-slot:option="{item}">
        {{ item.title }}
        </template>
    </UiSelectGroup>
  </div>
</template>

<script setup>
import attributeType from "@/definitions/attribute-types"
import { ref } from "vue";
const props = defineProps({
  form: Object,
});

const options = ref(attributeType);
</script>

<style lang="scss" scoped></style>
