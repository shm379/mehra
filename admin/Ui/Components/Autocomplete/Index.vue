<template>
  <div class="relative">
    <ui-label>{{ label }}</ui-label>
    <div
      class="w-full flex flex-nowrap gap-2 h-14 overflow-x-auto overflow-y-none rounded-xl border pr-2"
    >

      <div
        :key="i"
        v-if="selectedOptions"
        class="flex flex-row min-w-15 items-center justify-start gap-2 my-2 bg-neutral-200/70 text-xs p-1 rounded-lg"
        v-for="(item, i) in multiselect ? selectedOptions : [selectedOptions]"
      >
        <slot name="tag" :item="item" />
        <svg
          xmlns="http://www.w3.org/2000/svg"
          @click="remove(i)"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-4 h-4 stroke-gray-500 hover:stroke-red-500 cursor-pointer"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </div>
      <input
        class="appearance-none border-none bg-transparent w-full outline-none ml-2"
        v-model="search"
      />
      <div
        v-if="items"
        ref="results"
        class="absolute w-full max-h-32 overflow-y-scroll bg-white top-[86px] flex flex-col gap-1 rounded-lg shadow-lg p-2 z-50"
      >
        <p
          class="hover:bg-slate-100 rounded-lg p-2 cursor-pointer hover:border hover:shadow-inner"
          @click="select(item,i)"
          :key="i"
          v-for="(item, i) in items"
        >
          <slot name="item" :item="item">{{ item.title }}</slot>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, watch, reactive, onServerPrefetch } from "vue";
import { onClickOutside } from "@vueuse/core";
const emit = defineEmits(["update:modelValue"]);
const results = ref();
const search = ref("");
const items = ref(false);
const props = defineProps({
  label: String,
  api: "",
  modelValue: {
    type: [Array, Object],
    default: () => {},
  },
  multiselect: {
    type: Boolean,
    default: true,
  },
});

const selectedOptions = computed({
  get: () => props.modelValue,
  set: (v) => {
    emit("update:modelValue", v);
  },
});
function removeUndefined(obj) {
    return Object.fromEntries(
        Object.entries(obj)
            .filter(([_, value]) => value != undefined)
            .map(([key, value]) => [
                key,
                value === Object(value) ? removeUndefined(value) : value,
            ]),
    );
}


function remove(i) {
    if (props.multiselect) {
    var values = selectedOptions.value;
    delete values[i]
    selectedOptions.value = removeUndefined(values);
  } else selectedOptions.value = null;
  items.value = null;
}
watch(search, async (n, o) => {
  if (n) {
    const s = await fetch(props.api + n).then((response) => response.json());

        items.value = s.filter(function(value, index, arr){
            const vv = selectedOptions.value || {}
            console.log(vv)
          return !Object.entries(vv).find(v => v == value)
      })

  }
});
onClickOutside(results, (event) => (items.value = null));
function select(v,i) {
  if (props.multiselect) {
      selectedOptions.value[i] = v
    console.log(v);
  } else selectedOptions.value = v;

  items.value = null;
  search.value = null;
}
function pluck(arr, key) {
    return arr.map(obj => obj[key]);
}
</script>

<style lang="scss" scoped></style>
