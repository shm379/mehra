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
            </ui-box>
        </ui-col>
    </ui-row>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import UiPageHeader from "@/Components/Ui/Page/Header.vue";
import UiPageHeaderAction from "@/Components/Ui/Page/HeaderAction.vue";
import UiPageHeaderAnchors from "@/Components/Ui/Page/HeaderAnchors.vue";
import UiFormAttributeInfo from "@/Components/Ui/Form/AttributeInfo.vue";
import UiFormAttributeSpecefication from "@/Components/Ui/Form/AttributeSpecification.vue";
import UiRow from "@/Components/Ui/Row.vue";
import UiCol from "@/Components/Ui/Col.vue";
import UiBox from "@/Components/Ui/Page/Box.vue";
import Status from "@/Components/Status.vue"

export default {
    layout: AdminLayout,
    components: {
        UiPageHeader,
        UiPageHeaderAction,
        UiPageHeaderAnchors,
        UiRow,
        UiCol,
        UiBox,
        Status,
        UiFormAttributeSpecefication,
        UiFormAttributeInfo
    },
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
        anchor: "attribute-specification",
    },

];
const form = useForm({
    name: "",
    en_name: '',
    slug: "",
    type: "",
    value: [],
});
</script>

<style lang="scss" scoped>

</style>
