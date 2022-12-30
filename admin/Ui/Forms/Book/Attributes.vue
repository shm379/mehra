<template>
    <ui-row>
        <component :is="`ui-form-attribute-index`" :form="form" />
    </ui-row>
</template>

<script setup>

const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
