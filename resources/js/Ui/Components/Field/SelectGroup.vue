<template>
        <UiLabel>{{ label }}</UiLabel>

  <div
    class="flex flex-row items-center justify-around space-x-2 rounded-xl bg-gray-100  duration-500 border p-1"
  >
    <div v-for="(item, i) in options" :key="i" class="grow duration-500">
      <div class=" rounded-xl text-center py-2 px-5 cursor-pointer select-none" @click="select(i)" :class="{ 'border text-red-600 bg-neutral-200 border-red-600 border': i == model}">
        <slot name="option" :item="item">
          <label
            :for="i"
            class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:shadow-inner shadow-black peer-checked:bg-primary-500 peer-checked:font-bold peer-checked:text-white"
            >{{ item }}</label
          >
        </slot>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from "vue";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
  label: String,
  modelValue: [Number, Array, Object, String],
  options: Array,
  valueKey: {
    type: String,
    default: 'value'
  }
});
const model = computed({
  get: () => props.modelValue,
  set: (v) => {
    console.log(props.options[v]);

    emit("update:modelValue", v);
  },
});

function select(i) {
  model.value = i;
}
</script>

<style lang="scss" scoped></style>
