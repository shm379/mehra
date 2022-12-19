<template>
  <ui-page-header title="لیست انبارها">
    <ui-page-header-action to="admin.stocks.create"
    >افزودن انبار جدید</ui-page-header-action
    >
  </ui-page-header>
  <ui-row>
    <ui-col full>
      <a
          href=""
          class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
      >
        لیست انبارها
      </a>
    </ui-col>
  </ui-row>
  <ui-row>
    <ui-col full>
        <ui-datagrid :columns="columns" :data="stocks" :actions="actions" baseRoute="admin.stocks.index" />
    </ui-col>
  </ui-row>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
    layout: AdminLayout,
};
</script>
<script setup>
import { ref } from "vue";
const {columns,sections, actions} = useStock()

const props = defineProps({
    stocks: Array,
});

</script>
