<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="عنوان" :errors="$page.props.errors" v-model="form.title" error="title"></ui-input>
        <ui-input label="عنوان انگلیسی" :errors="$page.props.errors" v-model="form.slug" error="slug"></ui-input>
        <ui-textarea label="توضیحات" :errors="$page.props.errors" v-model="form.description" error="description"></ui-textarea>
    </div>
</template>

<script setup>


const props = defineProps({
    form: Object
})

</script>

<style lang="scss" scoped>

</style>
