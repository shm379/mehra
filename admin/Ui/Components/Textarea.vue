<template>
  <div class="flex flex-col gap-4">
    <label class="text-sm text-slate-600">{{ label }}</label>
      <Editor
          v-model="input"
          api-key="1aobaxzog28dmqypgp85ul7s555isascx4tk44tme7vpzuni"
          :init="{
              language: 'fa',
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    }"
      />
      <div class="text-xs text-slate-300">
          <span v-if="!description">حداقل ۳۰۰ حرف باید وارد کنید</span>
          <span v-else>{{description}}</span>
      </div>
  </div>
</template>

<script setup>
import Editor from '@tinymce/tinymce-vue'
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
