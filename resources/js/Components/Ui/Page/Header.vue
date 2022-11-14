<template>
  <Head :title="title" />
  <div class="flex flex-row justify-between items-center h-32">
    <h3 class="text-red-500 font-bold text-lg">{{ title }}</h3>
    <slot></slot>
  </div>
  <div class="py-12">
    <nav class="flex border-b border-gray-100 text-sm font-medium">
      <a
        href=""
        class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
      >
        اطلاعات کاربری
      </a>
    </nav>
  </div>
  <div
    v-if="$page.props.flash.error"
    class="text-red-500 border-red-500 bg-red-50 border p-5 rounded-lg mb-10 duration-1000"
  >
    {{ $page.props.flash.error }}
  </div>
  <div
    v-if="$page.props.flash.success"
    class="text-emerald-500 border-green-500 bg-emerald-50 border p-5 rounded-lg mb-10 duration-1000"
  >
    {{ $page.props.flash.success }}
  </div>
</template>

<script setup>
const props = defineProps({
    title: String
})
</script>

<style lang="scss" scoped></style>
