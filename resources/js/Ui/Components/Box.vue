<template>
  <div class="rounded-xl bg-gray-100 p-5 my-5 ">
    <div class="flex cursor-pointer flex-row justify-between" @click="toggle">
      <h1 class="grow font-bold pb-5">{{ title }}</h1>
      <svg
        
        :class="{'rotate-90': !open}"
        width="21"
        height="2"
        viewBox="0 0 21 2"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M1.23917 1.375H19.9892C20.1767 1.375 20.3642 1.23438 20.3642 1.04688C20.3642 0.8125 20.1767 0.625 19.9892 0.625H1.23917C1.0048 0.625 0.864173 0.8125 0.864173 1.04688C0.864173 1.23438 1.0048 1.375 1.23917 1.375Z"
          fill="#A3A3A3"
        />
      </svg>
    </div>
        <div v-show="open" class="duration-400">
            <slot />
        </div>

  </div>
</template>
<script setup>
import {ref } from "vue"
const props = defineProps({
    title : String
})
const open = ref(true);
function toggle() {
  open.value = !open.value;
}
</script>
