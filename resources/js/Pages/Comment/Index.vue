<template>
    <Header title="Comment" />
    <div class="flex flex-row justify-between items-center h-32">
        <h3 class="text-red-500 font-bold text-lg">لیست نظرات</h3>
        <Link
            class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
            as="div"
            href="#"
        >مشاهده لیست نظرات</Link
        >
    </div>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست نظرات
            </a>
        </nav>
        <datagrid :columns="columns" :data="comments" :actions="actions" baseRoute="admin.comments.index">
            <template v-slot:row-cell-points="{ item }">
                <div class="py-2">
                    <ul>
                        <li v-for="point in item">
                        <p v-if="point.status==='1'" class="text-xs bg-green-100 text-green-500 rounded-lg p-1">
                            {{point.title}}
                        </p>
                        <p v-else class="text-xs bg-red-100 text-red-500 rounded-lg p-1">
                            {{point.title}}
                        </p>
                        </li>
                    </ul>
                </div>
            </template>
            <template v-slot:row-cell-created_at="{ item }">
                {{ jDate(item) }}
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
import Datagrid from "@/Components/Datagrid.vue";
const props = defineProps({
    comments: Array,
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
        label: "نام نظر دهنده",
        field: "name",
        sortable: true,
    },
    {
        name: "points",
        label: "امتیازها",
        field: "points",
        sortable: true,
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
    { title: "نمایش", route: "admin.comments.show", color: "blue" },
    { title: "ویرایش", route: "admin.comments.edit", color: "orange" },
    { title: "حذف", route: "admin.comments.destroy", color: "red" },
];

function jDate(d) {
    return new Intl.DateTimeFormat('fa-IR').format(new Date(d))
}
</script>

<style lang="scss" scoped></style>
