<template>
    <ui-row>
        <ui-upload selectLabel="انتخاب صوت" :label="item.name" :key="i" v-for="item,i in $page.props.mediaCollections" :hidden="!item.acceptsMimeTypes.includes('audio/*')" v-model="form.media"></ui-upload>
    </ui-row>
</template>

<script setup>


const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
