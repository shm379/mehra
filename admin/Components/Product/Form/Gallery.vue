<template>
    <ui-row>
        <ui-upload :label="item.name" :key="i" v-for="item,i in $page.props.mediaCollections" :hidden="!item.acceptsMimeTypes.includes('images/*')" v-model="form.media"></ui-upload>
    </ui-row>
</template>

<script setup>

import {computed, ref} from "vue";

const props = defineProps({
  form: Object,
});


</script>

<style lang="scss" scoped></style>
