<template>
  <Upload v-model="form.gallery"></Upload>
</template>

<script setup>
import Upload from "@/Components/Upload.vue";

const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
