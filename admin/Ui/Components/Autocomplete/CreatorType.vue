<template>
    {{ type }}
    <ui-autocomplete api="/api/v1/ac/creators/types/" :label="label" v-model="type" >
                    <template #tag="{ item }">
                        <span>{{ item.name }}</span>
                    </template>
                    <template #item="{item}">
                        <span>{{ item.name }} / {{ item.plural_name }}</span>
                    </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({ modelValue: [Object, Array], label: {
    type: String,
    default: 'نویسنده / نویسندگان'
} })
const emit = defineEmits(["update:modelValue"]);

const type = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
