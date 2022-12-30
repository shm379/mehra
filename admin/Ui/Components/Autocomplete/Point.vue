<template>
    <ui-autocomplete api="/api/v1/ac/points/" label="افزودن نقطه قوت" v-model="point" :multiselect="false">
                    <template #tag="{ item }">
                        <span>{{ item.title }}</span>
                    </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({ modelValue: [Object, Array] })
const emit = defineEmits(["update:modelValue"]);

const point = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
