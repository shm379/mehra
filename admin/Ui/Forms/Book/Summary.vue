<template>
    <ui-row>
        <div>
            <ui-upload
                label=""
                selectLabel="انتخاب فایل"
            ></ui-upload>
        </div>
        <ui-col full>
            <ui-textarea
                description="حداقل ۳۰۰ حرف و حداکثر ۱۰۰۰ حرف باید وارد کنید"
                label="متن خلاصه گزیده کتاب"
                :errors="error"
                v-model="form.summary"
                error="summary"
            ></ui-textarea>
        </ui-col>
    </ui-row>
</template>

<script setup>


const props = defineProps({
    form: Object
})
</script>

<style lang="scss" scoped>

</style>
