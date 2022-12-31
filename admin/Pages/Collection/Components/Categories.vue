<template>
    <div class="grid grid-cols-1 gap-8" v-if="form.structure===1">
        <div class="grid grid-cols-1 gap-8">
            <ui-autocomplete-category v-model="category" >
            </ui-autocomplete-category>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    form: Object
})
const category = computed({
    get: () => props.form.categories,
    set(v) {
        var mv = props.form
        mv.categories = v
        emit("update:form", mv);
    },
});
</script>

<style lang="scss" scoped>

</style>
