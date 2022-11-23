<template>
  <ui-upload v-model="form.gallery"></ui-upload>
</template>

<script setup>

const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
