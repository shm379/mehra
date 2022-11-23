<template>
  <div class="flex flex-col gap-4 border-none bg-transparent">
    <label class="text-sm text-slate-600">{{ label }}</label>
    <input
      lang="fa"
      class="bg-neutral-200/50 rounded-xl outline-none border-none w-full p-3 focus:shadow-inner focus:shadow-slate-200 text-slate-500"
      :class="{ 'border-red-500 border bg-red-50': errors && errors[error] }"
      v-model="input"
      v-bind="$attrs"
    />
    <div class="text-xs text-red-600" v-if="errors && errors[error]">
      {{ errors[error] }}
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
  modelValue: String,
  label: String,
  error: String,
  errors: [Array, Object, Boolean],
});
const input = computed({
  get: () => props.modelValue,
  set(v) {
    emit("update:modelValue", v);
  },
});
</script>

<style lang="scss" scoped></style>
