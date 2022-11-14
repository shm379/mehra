<template>
  <div class="py-12">
    <nav class="flex border-b border-gray-100 text-sm font-medium">
      <a
        @click="selected = i"
        v-for="item,i in anchors"
        :href="`#${item.anchor}`"
        class="-mb-px  font-bold border-current p-4 "
        :class="{' border-b-4 border-b-red-500': selected == i}"
      >
       {{item.title}}
      </a>
    </nav>
  </div>
  <div
    v-if="$page.props.flash.error"
    class="text-red-500 border-red-500 bg-red-50 border p-5 rounded-lg mb-10 duration-1000"
  >
    {{ $page.props.flash.error }}
  </div>
  <div
    v-if="$page.props.flash.success"
    class="text-emerald-500 border-green-500 bg-emerald-50 border p-5 rounded-lg mb-10 duration-1000"
  >
    {{ $page.props.flash.success }}
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
</script>
