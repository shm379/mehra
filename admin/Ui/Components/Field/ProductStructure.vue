<template>
    <ui-field-select
        @update:modelValue="update"
        label="انتخاب ساختار"
        :options="structures"
        selectLabel="ساختار محصول را انتخاب کنید"
        v-model="structure"
        name="structure"
    />
</template>

<script setup>
import {computed, ref} from "vue"
import {Inertia} from "@inertiajs/inertia";

const structures = ref();

async function loadStructures() {
    structures.value = await fetch("/api/v1/ac/product-structures").then((response) =>
        response.json()
    );
    // structure.value = structures.value.find(item=>item.value===1)
}

loadStructures();


const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: Number,
})
const structure = computed({
    get: () => props.modelValue,
    set(v) {

        var mv = form;

        mv.structure = v;
        // emit("update:form", mv);
        // if(v===2){
        //     pageSections.value.push({
        //         title: "فایل های صوتی",
        //         anchor: "book-sounds",
        //     })
        //     Inertia.reload({
        //         preserveState:true,
        //     })
        //
        // }
    },
});
function update(modelValue) {
    emit('update:modelValue', modelValue)
}

</script>

<style lang="scss" scoped>

</style>
