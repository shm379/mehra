<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="عنوان" :errors="$page.props.errors" v-model="form.title" error="title"></ui-input>
        <ui-input label="عنوان فرعی یا زیرعنوان" :errors="$page.props.errors" v-model="form.sub_title" error="title"></ui-input>
    </div>
</template>

<script setup>


const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
