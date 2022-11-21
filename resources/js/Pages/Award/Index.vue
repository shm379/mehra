<template>
    <Header title="Award" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست جوایز / افتخار ها</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="a"
            :href="route('admin.awards.create')"
        >اضافه کردن جایزه / افتخار</Link>
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست جوایز / افتخار ها
            </a>
        </nav>
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
        <div class="py-12">
            <datagrid :columns="columns" :data="awards" :actions="actions" baseRoute="admin.awards.index" />
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
    awards: Array,
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
        label: "عنوان",
        field: "title",
        sortable: true,
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
        name: "actions",
        label: "عملیات",
        type: "action",
    },
];
const actions = [
    { title: "نمایش", route: "admin.creators.show", color: "blue" },
    { title: "ویرایش", route: "admin.creators.edit", color: "orange" },
    { title: "حذف", route: "admin.creators.destroy", color: "red" },
];
</script>
