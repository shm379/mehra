<template>
    <div>
        <select class="rounded-xl bg-slate-200/80 border-slate-300/80 border">
            <option v-for="(item,i) in setting">
            {{ item.name }}
            </option>
        </select>
    </div>
</template>

<script setup>
import {computed } from "vue"
const props = defineProps({
    form: Object,
    setting: [Boolean,Object]
})
const template = computed({
    get: () => props.form.template,
    set(v) {
        var mv = props.form;
        mv.template = v;
        mv.category_template_id = v.id;
        emit("update:form", mv);
    },
});

</script>

<style lang="scss" scoped>

</style>
