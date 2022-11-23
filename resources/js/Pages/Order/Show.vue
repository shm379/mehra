<template>
    <ui-page-header title="جزئیات سفارش">
        <ui-page-header-action to="admin.orders.index"
        >مشاهده لیست سفارشات</ui-page-header-action>
    </ui-page-header>
    <ui-row>
        <ui-col wide>
            <ui-page-header-anchors v-model="sections"></ui-page-header-anchors>
        </ui-col>

    </ui-row>
    <ui-row v-for="(row,i) in sections" :key="i">
        <ui-col v-for="(item, i) in row" :wide="item.wide" :full="item.full">
            <ui-box

                :key="i"
                :title="item.title"
                :id="item.anchor"
            >
                <component :is="`ui-form-${item.anchor}`" :setting="item.props ? item.props : false" :form="form" />
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
import UiFormOrderStatus from "@/Components/Ui/Form/Order/Status.vue";
import UiRow from "@/Components/Ui/Row.vue";
import UiCol from "@/Components/Ui/Col.vue";
import UiBox from "@/Components/Ui/Page/Box.vue";

export default {
    layout: AdminLayout,
    components: {
        UiPageHeader,
        UiPageHeaderAction,
        UiPageHeaderAnchors,
        UiRow,
        UiCol,
        UiBox,
        UiFormOrderStatus
    },
};
</script>

<script setup>
import sections from "@/Modules/Order/show.js";
const props = defineProps({
    order: Array
})

const form = useForm({
    first_name: "",
    last_name: "",
    address: "",
    mobile: "",
    phone: "",
    created_at: "",
    shipping_status: "",
    status: "",
    total: "",
});
</script>

<style lang="scss" scoped></style>
