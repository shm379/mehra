<template>
    <Header title="Attribute" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست سفارش ها</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="div"
            href="#"
        >مشاهده لیست سفارش ها</Link
        >
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست سفارش ها
            </a>
        </nav>
        <div class="py-12">
            <ui-datagrid :columns="columns" :data="orders" :actions="actions" baseRoute="admin.orders.index" />
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
    orders: Array,
});
const columns = [
    {
        name: "id",
        label: "شماره ردیف",
        field: "id",
        sortable: true,
    },
    {
        name: "discount",
        label: "تخفیف",
        field: "discount",
        sortable: true,
    },
    {
        name: "total_price",
        label: "قیمت کل",
        field: "total_price",
        sortable: false,
    },
    {
        name: "total_price_without_discount",
        label: "قیمت کل (بدون تخفیف)",
        field: "total_price_without_discount",
        sortable: false,
    },
    {
        name: "status",
        label: "وضعیت",
        field: "status",
        sortable: false,
    },
    {
        name: "items",
        label: "محصولات",
        field: "items",
        sortable: false,
    },
    {
        name: "notes",
        label: "یادداشت ها",
        field: "notes",
        sortable: false,
    },
    {
        name: "actions",
        label: "عملیات",
        type: "action",
    },
];
const actions = [
    { title: "نمایش", route: "admin.orders.show", color: "blue" },
    { title: "ویرایش", route: "admin.orders.edit", color: "orange" },
    { title: "حذف", route: "admin.orders.destroy", color: "red" },
];
</script>
