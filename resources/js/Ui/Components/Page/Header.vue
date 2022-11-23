<template>
  <Head :title="title" />
  <div class="flex flex-row justify-between items-center h-32">
    <h3 class="text-red-500 font-bold text-lg">{{ title }}</h3>
    <div class="flex flex-row gap-4"><slot></slot></div>
  </div>
</template>

<script setup>
const props = defineProps({
    title: String
})
</script>

<style lang="scss" scoped></style>
