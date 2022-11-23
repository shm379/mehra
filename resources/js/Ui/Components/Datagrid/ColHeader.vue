<template>
    <div class="flex flex-row items-center justify-start gap-2 select-none">
        <span>{{ col.label }}</span>
        <div><ui-datagrid-sort @sort="$emit('sort', $event)" :col="col" /></div>
    </div>
</template>

<script setup>
import sort from "./Sort.vue"
const props = defineProps({
    col: Object,
})
</script>

<style lang="scss" scoped>

</style>
