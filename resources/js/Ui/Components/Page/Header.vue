<template>
  <Head :title="title" />
  <div class="page-header">
    <h3 class="page-header-title">{{ title }}</h3>
    <div class="page-header-nav"><slot></slot></div>
  </div>
</template>

<script setup>
const props = defineProps({
    title: String
})
</script>

<style lang="scss" scoped></style>
