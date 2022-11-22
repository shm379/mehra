<template>
  <div class="w-5 h-5 cursor-pointer text-slate-300 hover:text-red-500" @click="change()" v-if="col.sortable">
    <svg
      class="w-5 h-5"
      v-if="state == 'asc'"
      xmlns="http://www.w3.org/2000/svg"
      width="0.63em"
      height="1em"
      preserveAspectRatio="xMidYMid meet"
      viewBox="0 0 320 512"
    >
      <path
        fill="currentColor"
        d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9S19 224.1 32 224.1h256c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"
      />
    </svg>
    <svg
      v-else-if="state == 'decs'"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="xMidYMid meet"
      class="w-5 h-5"
      viewBox="0 0 320 512"
    >
      <path
        fill="currentColor"
        d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9S19 287.9 32 287.9h256c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z"
      />
    </svg>
    <svg
      class="w-5 h-5"
      v-else-if="state == 'none'"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="xMidYMid meet"
      viewBox="0 0 320 512"
    >
      <path
        fill="currentColor"
        d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9S301 224.1 288 224.1H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9S19.1 288 32.1 288H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z"
      />
    </svg>
  </div>
</template>

<script setup>
import { useCycleList } from "@vueuse/core";
import { ref } from "vue";
const emit = defineEmits(["sort"]);
const props = defineProps({
  col: Object,
});
const list = ["asc", "decs", "none"];
const { state, index, next, prev } = useCycleList(list, { initialValue: "none" });

function change() {
  next();
  emit("sort", { col: props.col, order: state.value });
}
</script>

<style lang="scss" scoped></style>
