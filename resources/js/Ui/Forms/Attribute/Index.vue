<template>
  <div>
    {{ form.attributes }}
    <div v-for="item,i in attributes" :key="i">
      <component :is="`ui-form-attributes-${attributeFields[item.type]}`" v-model="form.attributes" :attribute="item" />
    </div>
  </div>
</template>



<script setup>
import { ref } from "vue";
const props = defineProps({
  form: Object,
});
const attributes = ref();

const attributeFields = ref({
  1: "multi-choice",
  2: "single-choice",
  3: "yes-or-no",
  4: "number",
  5: "color",
  6: "textarea",
  7: "input",
  8: "weight",
  9: "dimension",
});

load();
async function load() {
  attributes.value = await fetch("/api/v1/ac/attributes").then((response) =>
    response.json()
  );
}
</script>
