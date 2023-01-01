<template>
    <ui-page-header title="لیست سفارشات">
        <ui-page-header-action to="admin.orders.index"
        >مشاهده سفارشات</ui-page-header-action>
    </ui-page-header>
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
const {columns , actions } = useOrder()
</script>
