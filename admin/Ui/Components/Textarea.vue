<template>
  <div class="flex flex-col gap-4">
    <label class="text-sm text-slate-600">{{ label }}</label>
    <textarea
      class="bg-neutral-200/50 rounded-xl outline-0 w-full p-3 focus:shadow-inner focus:shadow-slate-200 text-slate-500"
      :class="{ 'border-red-500 border bg-red-50': errors && errors[error] }"
      v-model="input"
    ></textarea>
    <div class="text-xs text-red-600" v-if="errors && errors[error]">{{ errors[error] }}</div>
    <div class="text-xs text-slate-300" v-else>
        <span v-if="!description">حداقل ۳۰۰ حرف باید وارد کنید</span>
        <span v-else>{{description}}</span>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
  modelValue: String,
  description: String,
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
