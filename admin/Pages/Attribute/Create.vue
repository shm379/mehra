<template>
    <ui-page-header title="افزودن ویژگی‌ها">
        <ui-page-header-action to="admin.attributes.index">مشاهده لیست ویژگیها</ui-page-header-action>
        <ui-page-header-action to="admin.attributes.create">افزودن ویژگی جدید</ui-page-header-action>
    </ui-page-header>
    <ui-row>
        <ui-col full>
            <ui-page-header-anchors v-model="pageSections"></ui-page-header-anchors>
        </ui-col>
    </ui-row>
    <ui-row>
        <ui-col wide>
            <ui-box v-for="(item, i) in pageSections" :key="i" :title="item.title" :id="item.anchor">
                <component :is="`ui-form-${item.anchor}`" :setting="item.props ? item.props : false" :form="form" />
            </ui-box>
        </ui-col>
        <ui-col>
            <ui-box title="وضعیت">
                <Status v-model="form.status"></Status>
                        <button type="submit" :disabled="form.processing || !form.isDirty"
                            class="disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10">
                            ذخیره
                        </button>

            </ui-box>
        </ui-col>
    </ui-row>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    layout: AdminLayout,
};
</script>

<script setup>
const props = defineProps({
    templates: Array
})
const pageSections = [
    {
        title: "مشخصات ",
        anchor: "attribute-info",
    },
    {
        title: "مشخصه‌ها",
        anchor: "attribute-specefication",
    },

];
const form = useForm({
    name: "",
    en_name: '',
    slug: "",
    type: "",
    value: null,
});
</script>

<style lang="scss" scoped>

</style>
