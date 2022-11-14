<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="عنوان" :errors="error" v-model="form.title" error="title"></ui-input>
        <ui-input label="عنوان فرعی یا زیرعنوان" :errors="error" v-model="form.sub_title" error="title"></ui-input>
        <ui-textarea label="توضیحات" :errors="error" v-model="form.description" error="title"></ui-textarea>
    </div>
</template>

<script setup>
import UiInput from "@/Components/Ui/Field/Input.vue"
import UiTextarea from "@/Components/Ui/Field/Textarea.vue"
const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
