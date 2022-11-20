<template>
    <Header title="Attribute" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست کالکشن ها</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="div"
            href="#"
        >مشاهده لیست کالکشن ها</Link
        >
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست کالکشن ها
            </a>
        </nav>
        <div class="py-12">
            <datagrid :columns="columns" :data="collections" :actions="actions" baseRoute="admin.collections.index" />
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
import datagrid from "@/Components/Datagrid.vue";

const props = defineProps({
    collections: Array,
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
        label: "نام دسته",
        field: "title",
        sortable: true,
    },
    {
        name: "description",
        label: "توضیحات",
        field: "description",
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
        name: "user",
        label: "ساخته شده توسط",
        field: "user",
        sortable: false,
    },
    {
        name: "actions",
        label: "عملیات",
        type: "action",
    },
];
const actions = [
    { title: "نمایش", route: "admin.categories.show", color: "blue" },
    { title: "ویرایش", route: "admin.categories.edit", color: "orange" },
    { title: "حذف", route: "admin.categories.destroy", color: "red" },
];
</script>
