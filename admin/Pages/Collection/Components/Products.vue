<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-autocomplete-product v-model="product" label="محصول / محصولات">
        </ui-autocomplete-product>
    </div>
</template>

<script setup>
import {computed, onMounted} from "vue";

onMounted(()=>{
    props.form.items = {}
})
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object
})
const product = computed({
    get: () => props.form.items,
    set(v) {
        var mv = props.form
        mv.items = v
        emit("update:form", mv);
    },
});
</script>

<style lang="scss" scoped>

</style>
