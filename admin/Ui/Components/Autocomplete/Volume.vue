<template>
    <ui-autocomplete api="/api/v1/ac/volumes/" label="سری" v-model="volume" :multiselect="true">
                    <template #tag="{ item }">
                        <span>{{ item.title }}</span>
                    </template>
    </ui-autocomplete>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({ modelValue: [Object, Array] })
const emit = defineEmits(["update:modelValue"]);

const volume = computed({
    get: () => props.modelValue,
    set(v) {
        emit("update:modelValue", v);
    },
});
</script>

<style lang="scss" scoped>

</style>
