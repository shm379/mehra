<template>
  <div>
    <ui-label class="text-center">{{ label }}</ui-label>
    <div
      @click="open=true"
      class="cursor-pointer w-36 h-36 border border-dashed border-slate-400 rounded-xl bg-white flex flex-col place-content-center place-items-center gap-2"
    >
      <div>
        <svg
          width="36"
          height="32"
          viewBox="0 0 36 32"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M10.125 18.0869C10.125 13.7979 13.6406 10.2119 18 10.2119C22.2891 10.2119 25.875 13.7979 25.875 18.0869C25.875 22.4463 22.2891 25.9619 18 25.9619C13.6406 25.9619 10.125 22.4463 10.125 18.0869ZM18 11.3369C14.2031 11.3369 11.25 14.3604 11.25 18.0869C11.25 21.8135 14.2031 24.8369 18 24.8369C21.7266 24.8369 24.75 21.8135 24.75 18.0869C24.75 14.3604 21.7266 11.3369 18 11.3369ZM25.4531 2.40723L26.2266 4.58691H31.5C33.9609 4.58691 36 6.62598 36 9.08691V27.0869C36 29.6182 33.9609 31.5869 31.5 31.5869H4.5C1.96875 31.5869 0 29.6182 0 27.0869V9.08691C0 6.62598 1.96875 4.58691 4.5 4.58691H9.70312L10.4766 2.40723C10.8984 1.07129 12.1641 0.0869141 13.6406 0.0869141H22.2891C23.7656 0.0869141 25.0312 1.07129 25.4531 2.40723ZM4.5 5.71191C2.60156 5.71191 1.125 7.25879 1.125 9.08691V27.0869C1.125 28.9854 2.60156 30.4619 4.5 30.4619H31.5C33.3281 30.4619 34.875 28.9854 34.875 27.0869V9.08691C34.875 7.25879 33.3281 5.71191 31.5 5.71191H25.3828L24.3984 2.75879C24.1172 1.84473 23.2734 1.21191 22.2891 1.21191H13.6406C12.6562 1.21191 11.8125 1.84473 11.5312 2.75879L10.5469 5.71191H4.5Z"
            fill="#5C5C5C"
          />
        </svg>
      </div>
      <span class="text-sm text-slate-400" v-if="!selectLabel">انتخاب تصویر</span>
      <span class="text-sm text-slate-400" v-else>{{selectLabel}}</span>
    </div>
    <div class="relative mt-2" v-if="file">
      <img class="w-full rounded-xl h-20 object-cover" :src="file" alt="" />
      <div class="absolute top-0 left-0" @click="deleteFiles">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="mt-2 ml-2 w-4 h-4 hover:stroke-red-600 cursor-pointer"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
    </div>
    <components-core-modal-upload @select="log($event)" fullscreen :title="label" dir="rtl" v-model:active="open" />

  </div>
</template>

<script setup>
import { useFileDialog } from "@vueuse/core";
import { watch, ref } from "vue";
const { files, reset } = useFileDialog({ multiple: false });
const props = defineProps({
  label: { type: String, default: "تصویر" },
  modelValue: Object,
  selectLabel: String,
});
const file = ref();

function log(v) {
    console.log(v)
}
watch(files, (value) => {
  if (value[0]) {
    file.value = URL.createObjectURL(value[0]);
    console.log(file.value);
  }
});
const open = ref(false)
function deleteFiles() {
  file.value = false;
  files.value = null;
}
</script>

<style lang="scss" scoped></style>
