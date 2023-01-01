<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-autocomplete-category v-model="category" >
        </ui-autocomplete-category>
    </div>
</template>

<script setup>
import {computed, onMounted} from "vue";

const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object
})
onMounted(()=>{
    props.form.items = {}
})
const category = computed({
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
