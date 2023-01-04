<template>
  <div :class="defaultClass">
    <label class="text-sm text-slate-600">{{ label }}</label>
    <input style="height: 55px"
      lang="fa"
      class="input"
      :class="{ 'border-red-500 border bg-red-50': errors && errors[error] }"
      v-model="input"
      v-bind="$attrs"
      :type="inputType"
    />
    <div class="text-xs text-red-600" v-if="errors && errors[error]">
      {{ errors[error] }}
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
  modelValue: [String,Number],
  label: String,
  error: String,
  errors: {
      type: [Array, Object, Boolean],
      default: usePage().props.errors ? usePage().props.errors : false
  },
  defaultClass : {
      type: String,
      default: 'input-container'
  },
  inputType : {
      type: String,
      default: 'text'
  },
});
const input = computed({
  get: () => props.modelValue,
  set(v) {
    emit("update:modelValue", v);
  },
});
</script>

<style lang="scss" scoped></style>
