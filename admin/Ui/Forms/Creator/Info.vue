<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-input label="نام" :errors="error" v-model="form.title" error="name"></ui-input>
        <ui-input label="نام کوچک" :errors="error" v-model="form.first_name" error="first_name"></ui-input>
        <ui-input label="نام بزرگ" :errors="error" v-model="form.last_name" error="last_name"></ui-input>
        <ui-input  class="w-2/3" label="سال تولد" :errors="error" v-model="form.birthday" error="birthday" />
        <ui-input label="تخلص" class="w-2/3" :errors="error" v-model="form.nickname" error="nickname"></ui-input>
        <ui-input label="عنوان فرعی یا زیرعنوان" :errors="error" v-model="form.slug" error="slug"></ui-input>
        <ui-autocomplete-creatpr-type label="تخصص" :errors="error" v-model="form.types" error="slug"></ui-autocomplete-creatpr-type>
        <ui-textarea label="بیوگرافی" :errors="error" v-model="form.description" error="description"></ui-textarea>
    </div>
</template>

<script setup>


const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
