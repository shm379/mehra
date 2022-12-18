<template>
    <Header title="User" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست محصولات</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="a"
            :href="route('admin.products.create')"
        >افزودن محصول جدید</Link
        >
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست محصولات
            </a>
        </nav>
        <div class="py-12">
          <ui-datagrid :columns="columns" :data="products" :actions="actions" baseRoute="admin.products.index">

          </ui-datagrid>

        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
    layout: AdminLayout,
};
</script>
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import { setTranslations } from "@protonemedia/inertiajs-tables-laravel-query-builder";

setTranslations({
    next: "بعدی",
    no_results_found: "یافت نشد!",
    of: "از",
    per_page: "",
    previous: "قبلی",
    results: "نتیجه",
    to: "از",
    reset: "ریست"
});
const props = defineProps({
    products: Array,
});
const actions = [
    { title: "نمایش", route: "admin.products.show", color: "blue" },
    { title: "ویرایش", route: "admin.products.edit", color: "orange" },
    { title: "حذف", route: "admin.products.destroy", color: "red" },
];
function jDate(d) {
    return new Intl.DateTimeFormat('fa-IR').format(new Date(d))
}
</script>

<style>
input.block.w-full.pl-9.text-sm.rounded-md.shadow-sm.focus\:ring-indigo-500.focus\:border-indigo-500.border-gray-300{
    height:100%;
}
div[role=menu] button {
    direction: ltr;
}
.absolute.inset-y-0.right-0.pr-3.flex.items-center {
    left: 0;
    right: auto;
}
div[aria-labelledby="filter-menu"] {
    display: flex;
}
nav[aria-label="Pagination"] a[dusk="pagination-next"],
nav[aria-label="Pagination"] a[dusk="pagination-previous"],
nav[aria-label="Pagination"] div.cursor-not-allowed{
    transform: rotate(180deg);
}
</style>
