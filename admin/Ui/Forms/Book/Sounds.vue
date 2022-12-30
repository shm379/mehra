<template>
    <ui-row>
        <ui-upload
            label="فایل صوتی نمونه"
            selectLabel="انتخاب صوت"
        ></ui-upload>
        <ui-upload
            label="فایل صوتی اصلی"
            selectLabel="انتخاب صوت"
        ></ui-upload>
    </ui-row>
</template>

<script setup>


const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
