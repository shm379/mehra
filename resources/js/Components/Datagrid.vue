<template>
  <div class="">
    <table
      class="my-10 min-w-full overflow-x-auto rounded-lg text-sm text-left text-gray-500 dark:text-gray-400"
    >
      <thead>
        <tr>
          <th v-if="bulk"></th>
          <th class="text-right py-5" scope="col" v-for="(col, i) in columns" :key="i">
            <col-header :col="col" @sort="log"></col-header>
          </th>
        </tr>
        <tr>
          <th v-if="bulk"><input type="checkbox" v-model="all" /></th>
          <th class="text-right py-5" scope="col" v-for="(col, i) in columns" :key="i">
            <ui-input v-model="search[col.name]" :placeholder="col.label"></ui-input>
          </th>
        </tr>
      </thead>
      <tbody class="border rounded-lg">
        <tr v-for="(row, j) in data.data" :key="j" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 py-2">
          <th v-if="bulk"><input type="checkbox" v-model="selected[j]" class="py-4 px-6"/></th>
          <td v-for="(item, k) in row" :key="k" class="p-2 rounded-lg text-right py-4 px-6">
            <span v-if="slots[`row-cell-${k}`]"
              ><slot
                :row="row"
                :item="item"
                :field="k"
                :data="data.data"
                :name="`row-cell-${k}`"
              ></slot
            ></span>
            <span v-else v-html="item"></span>
          </td>
          <td v-if="slots['row-cell-action']" class="py-4 px-6">
            <slot :row="row" :item="item" :field="k" :data="data.data" :name="`row-cell-action`"></slot>
          </td>
          <td v-else  class="flex pt-2 flex-row items-center justfiy-between gap-1 py-4">
            <Link
              as="a"
              v-for="(action, l) in actions"
              :key="l"
              :href="route(action.route, { id: row.id })"
              :class="`bg-${action.color}-500 hover:shadow-xl opacity-70 hover:opacity-100 hover:scale-105 duration-100 cursor-pointer text-white rounded-lg px-2 p-1 text-xs`"
            >
              <span>{{ action.title }}</span>
            </Link>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="flex flex-row gap-2 items-center justify-between">
      <div>
        <span>نمایش </span
        ><select v-model="perPage" class="p-2 rounded-xl border border-gray-200 pl-5  pr-10  border" lang="fa">
          <option v-for="i in [3,5,10, 15, 20, 50, 100]" :value="i" :label="i" lang="ar" />
        </select>
      </div>
      <div class="flex flex-row justify-end items-center">
        <div>صفحه {{ data.current_page }} از {{ data.last_page }}</div>
        <nav aria-label="Page navigation example" dir="rtl">
          <ul class="inline-flex items-center -space-x-px text-sm">
            <li class="p-2" v-for="(link, l) in data.links">
              <Link
                :href="link.url"
                :class="{
                  'w-8 h-8 block flex items-center justify-center text-white   bg-red-500  rounded-full':
                    link.active,
                }"
                v-html="link.label"
                preserve-scroll
              ></Link>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, useSlots } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import ColHeader from "@/Components/Ui/Datagrid/ColHeader.vue"
import Pagination from "@/Components/Pagination.vue";
import UiInput from "@/Components/Ui/Field/Input.vue";
import { TableFilter } from "@protonemedia/inertiajs-tables-laravel-query-builder";

const props = defineProps({
  columns: Array,
  data: Array,
  actions: Array,
  baseRoute: String,
  bulk: Boolean,
});
const emit=defineEmits(["sort"])
const search = ref({});
const sort = ref({})
const selected = ref([]);
const perPage = ref(props.data.per_page);
const slots = useSlots();
watch(perPage, (newValue, oldValue) => {
  console.log(newValue);
});
function log(v) {
    if(v.order == 'none')
        sort.value = ''
    else
        if(v.order == "asc")
            sort.value = "-"+v.col.field
        else sort.value =  v.col.field
emit("sort", sort.value)
}
</script>

<style lang="scss" scoped></style>
