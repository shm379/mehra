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
                لیست کاربری
            </a>
        </nav>
        <div class="py-12">
            <datagrid :columns="columns" :data="users" :actions="actions" baseRoute="admin.users.index">
                <template v-slot:row-cell-email_verified_at="{ item }">
                    <div class="py-2">
                        <span v-if="!item" class="text-xs bg-red-100 text-red-500 rounded-lg p-1">تایید نشده</span>
                        <span v-else class="text-xs bg-green-100 text-green-500 rounded-lg p-1">تایید شده</span>
                    </div>
                </template>
            </datagrid>
        </div>
        <datagrid :columns="columns" :data="users" :actions="actions" baseRoute="admin.users.index" :bulk="true">
            <template v-slot:row-cell-email_verified_at="{ item }">
                <div class="py-2">
                    <span v-if="!item" class="text-xs bg-red-100 text-red-500 rounded-lg p-1">غیرفعال</span>
                    <span v-else class="text-xs bg-green-100 text-green-500 rounded-lg p-1">غیرفعال</span>
                </div>
            </template>

        </datagrid>
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
    users: Array,
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
        label: "نام و نام خانوادگی",
        field: "name",
        sortable: true,
    },
    {
        name: "mobile",
        label: "موبایل",
        field: "mobile",
        sortable: true,
    },
    {
        name: "gender",
        label: "جنسیت",
        field: "gender",
        sortable: true,
    },
    {
        name: "email",
        label: "پست الکترونیکی",
        field: "email",
        sortable: true,
    },
    {
        name: "verification",
        label: "تایید ایمیل",
        field: "email_verified_at",
        sortable: false,
    },
    {
        name: "comments_count",
        label: "تعداد نظرات",
        field: "comments_count",
        sortable: false,
    },
    {
        name: "balance",
        label: "موجودی",
        field: "balance",
        sortable: false,
    },
    {
        name: "created_at",
        label: "تاریخ ثبت نام",
        field: "created_at",
        sortable: true,
    },
    {
        name: "actions",
        label: "عملیات",
        type: "action",
    },
];
const actions = [
    { title: "نمایش", route: "admin.users.show", color: "blue" },
    { title: "ویرایش", route: "admin.users.edit", color: "orange" },
    { title: "حذف", route: "admin.users.destroy", color: "red" },
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
