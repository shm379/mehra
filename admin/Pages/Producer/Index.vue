<template>
    <Header title="Attribute" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست ناشر/برند/تولیدکننده ها</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="div"
            href="#"
        >مشاهده لیست ناشر/برند/تولیدکننده ها</Link
        >
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست ناشر/برند/تولیدکننده ها
            </a>
        </nav>
        <div class="py-12">
            <ui-datagrid :columns="columns" :data="producers" :actions="actions" baseRoute="admin.producers.index" />
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


const props = defineProps({
    producers: Array,
});
const columns = [
    {
        name: "id",
        label: "شماره ردیف",
        field: "id",
        sortable: true,
    },
    {
        name: "title",
        label: "نام",
        field: "title",
        sortable: true,
    },
    {
        name: "sub_title",
        label: "زیرعنوان",
        field: "sub_title",
        sortable: false,
    },
    {
        name: "slug",
        label: "نامک",
        field: "slug",
        sortable: false,
    },
    {
        name: "type",
        label: "نوع",
        field: "type",
        sortable: false,
    },
    {
        name: "is_active",
        label: "فعال؟",
        field: "is_active",
        sortable: false,
    },
    {
        name: "actions",
        label: "عملیات",
        type: "action",
    },
];
const actions = [
    { title: "نمایش", route: "admin.producers.show", color: "blue" },
    { title: "ویرایش", route: "admin.producers.edit", color: "orange" },
    { title: "حذف", route: "admin.producers.destroy", color: "red" },
];
</script>
