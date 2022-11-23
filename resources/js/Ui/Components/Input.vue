<template>
  <div class="input-container">
    <label class="text-sm text-slate-600">{{ label }}</label>
    <input
      lang="fa"
      class="input"
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
