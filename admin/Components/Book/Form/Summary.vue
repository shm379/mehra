<template>
    <ui-row>
        <div>
            <ui-upload selectLabel="انتخاب فایل" :label="item.name"  v-for="item,i in $page.props.mediaCollections" :hidden="!item.acceptsMimeTypes.includes('application/pdf')" v-model="form.media"></ui-upload>
        </div>
        <ui-col full>
            <ui-textarea
                description="حداقل ۳۰۰ حرف و حداکثر ۱۰۰۰ حرف باید وارد کنید"
                label="متن خلاصه گزیده کتاب"
                :errors="$page.props.errors"
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
