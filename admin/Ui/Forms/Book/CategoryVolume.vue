<template>
    <ui-row>
        <div class="w-6/12">
            <ui-autocomplete-volume v-model="volume">
            </ui-autocomplete-volume>
        </div>
        <div class="w-6/12">
            <ui-input label="شماره در مجموعه" :errors="$page.props.errors" v-model="form.order_volume" error="title"></ui-input>
        </div>
        <div
            style="margin: 20px 0"
            class="w-1/12 flex flex-row cursor-pointer justify-start items-center"
            @click="add"
        >

            <svg
                width="30"
                height="31"
                viewBox="0 0 30 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M29.875 15.5C29.875 15.8516 29.5938 16.0625 29.3125 16.0625H15.8125V29.5625C15.8125 29.9141 15.5312 30.1953 15.25 30.1953C14.8984 30.1953 14.6875 29.9141 14.6875 29.5625V16.0625H1.1875C0.835938 16.0625 0.625 15.8516 0.625 15.5703C0.625 15.2188 0.835938 14.9375 1.1875 14.9375H14.6875V1.4375C14.6875 1.15625 14.8984 0.945312 15.25 0.945312C15.5312 0.945312 15.8125 1.15625 15.8125 1.4375V14.9375H29.3125C29.5938 14.9375 29.875 15.2188 29.875 15.5Z"
                    fill="#A3A3A3"
                />
            </svg>

        </div>
    </ui-row>
</template>

<script setup>
import {computed, ref} from "vue";

const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object
})
const newVolume = ref();
const awards = computed({
    get: () => props.form.volume,
    set(v) {
        var mv = props.form;
        mv.volumes = v;
        emit("update:form", mv);
    },
});
function add() {
   //show modal
}
</script>

<style lang="scss" scoped>

</style>
