<template>
    <ui-row>
        <ui-upload v-model="form.gallery"></ui-upload>
        <ui-upload v-model="form.gallery"></ui-upload>
        <ui-upload v-model="form.gallery"></ui-upload>
    </ui-row>
</template>

<script setup>

const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
