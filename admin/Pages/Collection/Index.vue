<template>
    <ui-page-header title="لیست ها">
        <ui-page-header-action to="admin.collections.index"
        >مشاهده لیست ها</ui-page-header-action>
        <ui-page-header-action to="admin.collections.create"
        >افزودن لیست جدید</ui-page-header-action>
    </ui-page-header>
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
            <ui-datagrid :columns="columns" :data="collections" :actions="actions" baseRoute="admin.collections.index" />
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
    collections: Array,
});

const { sections, form } = useCollection()

</script>
