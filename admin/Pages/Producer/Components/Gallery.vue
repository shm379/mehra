<template>
  <div class="flex flex-row gap-4 ">
    <ui-upload label="تصویر اصلی" v-model="form.logo"></ui-upload>
  </div>
</template>

<script setup>

const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
