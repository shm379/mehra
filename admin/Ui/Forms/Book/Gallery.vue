<template>
    <ui-row>
        <ui-upload v-for="item,i in booksMedia" v-model="form.media[i]" :key="i"></ui-upload>
        <ui-add-upload v-model="booksMedia" />
    </ui-row>
</template>

<script setup>

import {ref} from "vue";

const booksMedia = ref();

load();
async function load() {
  booksMedia.value = await fetch("/api/v1/ac/media/books/images").then((response) =>
      response.json()
  );
}
const props = defineProps({
  form: Object,
});
</script>

<style lang="scss" scoped></style>
