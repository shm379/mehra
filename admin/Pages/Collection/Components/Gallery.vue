<template>
  <div class="flex flex-row gap-4 ">
    <ui-upload label="تصویر اصلی" v-model="form.main_image"></ui-upload>
    <ui-upload label="کاور موضوع" v-model="form.cover_image"></ui-upload>
  </div>
</template>

<script setup>

const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
