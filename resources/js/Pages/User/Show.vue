<template>
  <Header title="User" />
  <div class="flex flex-row justify-between items-center h-32">
    <h3 class="text-red-500 font-bold text-lg">لیست کاربران</h3>
    <Link
      class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
      as="div"
      href="#"
      >مشاهده لیست کاربران</Link
    >
  </div>
  <div class="py-12">
    <nav class="flex border-b border-gray-100 text-sm font-medium">
      <a
        href=""
        class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
      >
        <h2>{{ this.user.name }}</h2>
      </a>
    </nav>
  </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
  layout: AdminLayout,
};
</script>
<script setup>
const props = defineProps({
  user: Object,
});
function jDate(d) {
    return new Intl.DateTimeFormat('fa-IR').format(new Date(d))
}
</script>

<style lang="scss" scoped></style>
