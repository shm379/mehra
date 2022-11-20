<template>
    <Header title="Attribute" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست ویژگی ها</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="div"
            href="#"
        >مشاهده لیست ویژگی ها</Link
        >
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست ویژگی ها
            </a>
        </nav>
        <div class="py-12">
            <datagrid :columns="columns" :data="attributes" :actions="actions" baseRoute="admin.attributes.index" />
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
    attributes: Array,
});
const columns = [
    {
        name: "id",
        label: "شماره ردیف",
        field: "id",
        sortable: true,
    },
    {
        name: "name",
        label: "نام ویژگی",
        field: "name",
        sortable: true,
    },
    {
        name: "values",
        label: "مقادیر ویژگی",
        field: "values",
        sortable: false,
    },
    {
        name: "actions",
        label: "عملیات",
        type: "action",
    },
];
const actions = [
    { title: "نمایش", route: "admin.attributes.show", color: "blue" },
    { title: "افزودن مقدار", route: "admin.attributes.values.create", color: "orange" },
    { title: "حذف ویژگی", route: "admin.attributes.destroy", color: "red" },
];
</script>
