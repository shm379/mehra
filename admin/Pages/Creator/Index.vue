<template>
    <ui-page-header title="پدیدآورنده ها">
        <ui-page-header-action to="admin.creators.index"
        >مشاهده پدیدآورندگان</ui-page-header-action>
        <ui-page-header-action to="admin.creators.create"
        >افزودن پدیدآورنده جدید</ui-page-header-action>
    </ui-page-header>
    <div class="py-12">
        <nav class="flex border-b border-gray-100 text-sm font-medium">
            <a
                href=""
                class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
            >
                لیست پدیدآورنده ها
            </a>
        </nav>
        <div class="py-12">
            <ui-datagrid :columns="columns" :data="creators" :actions="actions" baseRoute="admin.creators.index" />
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
const {columns, actions} = useCreator()

const props = defineProps({
    creators: Array,
});

</script>
