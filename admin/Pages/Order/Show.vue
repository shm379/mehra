<template>
    <form-order :form="form"></form-order>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    layout: AdminLayout,
};
</script>

<script setup>
import {computed, onMounted, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
const props = defineProps({
    order: Object,
});
let {form} = useOrder();
for(const i in props.order){
    form[i] = props.order[i]
}

</script>

<style lang="scss" scoped></style>
