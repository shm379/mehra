<template>
    <Header title="Attribute" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست دسته بندی ها</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="div"
            href="#"
        >مشاهده لیست دسته بندی ها</Link
        >
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست دسته بندی ها
            </a>
        </nav>
        <div class="py-12">
            <ui-datagrid :columns="columns" :data="categories" :actions="actions" baseRoute="admin.categories.index" />
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
    categories: Array,
});
const columns = [
    {
        name: "id",
        label: "ID",
        field: "id",
        sortable: true,
    },
    {
        name: "title",
        label: "عنوان",
        field: "title",
        sortable: true,
    },
    {
        name: "order",
        label: "موقعیت",
        field: "order",
        sortable: false,
    },
    {
        name: "parent",
        label: "دسته اصلی",
        field: "parent",
        sortable: false,
    },
    {
        name: "products_no",
        label: "تعداد محصولات",
        field: "products_no",
        sortable: false,
    },
    {
        name: "status",
        label: "وضعیت",
        field: "status",
        sortable: false,
    },
    {
        name: "actions",
        label: "عملیات",
        type: "action",
    },
];
const actions = [
    { title: "مشاهده", route: "admin.categories.show" },
    { title: "ویرایش", route: "admin.categories.edit", color: "orange" },
    { title: "حذف", route: "admin.categories.destroy", color: "red" },
];
</script>
