<template>
    <div class="grid grid-cols-1 gap-4">
        <ui-input label="نام" v-model="first_name"></ui-input>
        <ui-input label="نام خانوادگی" v-model="last_name"></ui-input>
        <ui-input label="آدرس" v-if="form.address_id" v-model="address"></ui-input>
        <ui-input label="تلفن منزل" v-if="form.address_id" v-model="phone"></ui-input>
        <ui-input label="موبایل" v-model="mobile"></ui-input>
    </div>
</template>


<script setup>
import {computed} from "vue";

const props = defineProps({
    form: Object
})
const emit = defineEmits(['update:modelValue','update:form'])
const first_name = computed({
    get: () => props.form.address_id ? props.form.address.first_name : props.form.user.first_name,
    set(v) {
        var mv = props.form;
        if(mv.address_id){
            mv.address.first_name = v;
        } else {
            mv.user.first_name = v;
        }
        emit("update:form", mv);
    },
});
const last_name = computed({
    get: () => props.form.address_id ? props.form.address.last_name : props.form.user.last_name,
    set(v) {
        var mv = props.form;
        if(mv.address_id){
            mv.address.last_name = v;
        } else {
            mv.user.last_name = v;
        }
        emit("update:form", mv);
    },
});
const address = computed({
    get: () => props.form.address_id ? props.form.address.address : null,
    set(v) {
        var mv = props.form;
        if(mv.address_id){
            mv.address.address = v;
        } else {
            mv.user.address = v;
        }
        emit("update:form", mv);
    },
});
const phone = computed({
    get: () => props.form.address_id ? props.form.address.phone : null,
    set(v) {
        var mv = props.form;
        if(mv.address_id){
            mv.address.phone = v;
        } else {
            mv.user.phone = v;
        }
        emit("update:form", mv);
    },
});
const mobile = computed({
    get: () => props.form.address_id ? props.form.address.mobile : props.form.user.mobile,
    set(v) {
        var mv = props.form;
        if(mv.address_id){
            mv.address.mobile = v;
        } else {
            mv.user.mobile = v;
        }
        emit("update:form", mv);
    },
});

</script>
<style scoped>

</style>
