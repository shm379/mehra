<template>
  <div class="flex flex-row gap-4 ">
    <Upload label="تصویر پرتره" v-model="form.portrait"></Upload>
    <Upload label="کاور صفحه" v-model="form.cover"></Upload>
    <Upload label="ویدیو" v-model="form.video"></Upload>
  </div>
</template>

<script setup>
import Upload from "@/Components/Upload.vue";

const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
