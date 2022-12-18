<template>
  <div class="grid grid-cols-1 gap-8">
    <ui-autocomplete-category label="دسته‌بندی مادر" v-model="category" :multiselect="false">
    </ui-autocomplete-category>
  </div>
</template>

<script setup>
import { computed } from "vue";

const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
  form: Object,
});

const category = computed({
  get: () => props.form.parent,
  set(v) {
    var mv = props.form;
    mv.parent = v;
    mv.parent_id = v.id;
    emit("update:form", mv);
  },
});
</script>
