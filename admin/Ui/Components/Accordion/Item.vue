<template>
  <div class="flex flex-col gap-1">
    <h1 class="flex flex-row justify-between">
      <slot name="header"></slot>
      <div class="p-1 cursor-pointer" @click="toggle" :class="{ 'rotate-180': open }">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-4 h-4"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
          />
        </svg>
      </div>
    </h1>
    <div class="duration-500 ps-5 " v-show="open">
      <slot name="body"></slot>
    </div>
  </div>
</template>

<script setup>
import { ref, defineEmits } from "vue";
const emit = defineEmits(["change"]);
const open = ref(false);

function toggle() {
  open.value = !open.value;
  emit("change", open.value);
}
</script>

<style lang="scss" scoped></style>
