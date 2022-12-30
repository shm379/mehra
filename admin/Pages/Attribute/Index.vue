<template>
    <ui-page-header title="لیست ها">
        <ui-page-header-action to="admin.attributes.index"
        >مشاهده لیست ویژگی ها</ui-page-header-action
        >
        <ui-page-header-action to="admin.attributes.create"
        >افزودن ویژگی جدید</ui-page-header-action
        >
    </ui-page-header>
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
            <ui-datagrid @sort="onSort" :columns="columns" :data="attributes" :actions="actions" baseRoute="admin.attributes.index" />
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Inertia } from "@inertiajs/inertia";
export default {
    layout: AdminLayout,
};
</script>
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const sort = ref(null)
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
