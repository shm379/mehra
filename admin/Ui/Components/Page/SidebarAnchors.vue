<template>
  <div class="py-12">
    <nav class="page-sidebar-anchor">
      <a
        @click="selected = i"
        v-for="item,i in flat(anchors)"
        :href="`#${item.anchor}`"
        :aria-checked="selected == i"
        class="page-header-anchor-link "
        :class="{'selected': selected == i}"
      >
       {{item.title}}
      </a>

    </nav>
    <div class="flex justify-center mt-5">
        <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { computed, ref } from "vue";
const props = defineProps({
  modelValue: Array,
});

const selected = ref(0);
const anchors = computed({
  get: () => props.modelValue,
  set(v) {
    emit("update:modelValue", v);
  },
});

function flat(arr) {
    let flatArr = []
    arr.forEach(v => {
        flatArr = flatArr.concat(v)
    })
    return flatArr
}
</script>
