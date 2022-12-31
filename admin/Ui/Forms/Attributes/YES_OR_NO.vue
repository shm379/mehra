<template>
  <div class="form-check form-switch flex  justify-start gap-20">
    <input
      v-model="input"
      class="form-check-input appearance-none w-9 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
      type="checkbox"
      role="switch"
      id="flexSwitchCheckDefault"
    />
    <label
      class="form-check-label inline-block text-gray-800"
      for="flexSwitchCheckDefault"
      >{{ attribute.title }}</label
    >
  </div>
</template>

<script setup>
import { computed } from "vue";
;
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({ modelValue: Object, attribute: Object });
const input = computed({
  get: () => props.modelValue,
  set(v) {
    var modelValue = props.modelValue;
    modelValue = v;
    emit("update:modelValue", modelValue);
  },
});
</script>
