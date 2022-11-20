<template>
  <div class="">
    <table
      class="my-10 min-w-full overflow-x-auto  rounded-lg text-sm text-left text-gray-500 dark:text-gray-400"
    >
      <thead>
        <tr>
          <th class="text-right py-5" scope="col" v-for="(col, i) in columns" :key="i">
            {{ col.label }}
          </th>
        </tr>
      </thead>
      <tbody class="border rounded-lg">
        <tr v-for="(row, j) in data.data" :key="j" class="border-b">
          <td v-for="(item, k) in row" :key="k" class="p-2 rounded-lg text-right py-2">
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
          <td class="flex pt-2 flex-row items-center justfiy-between gap-1">
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
        ><select v-model="perPage" class="p-2 rounded-lg border" lang="fa">
          <option v-for="i in [10, 15, 20, 50, 100]" :value="i" :label="i" lang="ar" />
        </select>
      </div>
      <div class="flex flex-row justify-end items-center">
        <div>صفحه {{ data.current_page }} از {{ data.total }}</div>
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
              ></Link>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch,useSlots } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  columns: Array,
  data: Array,
  actions: Array,
  baseRoute: String
});

const perPage = ref(props.data.per_page);
const slots = useSlots();
watch(perPage,  (newValue, oldValue) => {
    console.log(newValue)
})
</script>

<style lang="scss" scoped></style>
