<template>
  <div>
    <div v-for="(item,i) in attributes" :key="i">
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
    const attributeFields = ref();

    loadAttributeTypes();
    load();
    async function loadAttributeTypes() {
        attributeFields.value = await fetch("/api/v1/ac/attribute-types").then((response) =>
        response.json()
      );
    }
    async function load() {
      attributes.value = await fetch("/api/v1/ac/attributes").then((response) =>
        response.json()
      );
    }
</script>
