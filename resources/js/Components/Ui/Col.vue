<template>
    <div :class="{'w-1/3':!wide && !full, 'w-2/3':wide, 'w-full': full}">
        <slot/>
    </div>
</template>

<script setup>
const props = defineProps({
    wide: {
        type: Boolean,
        default: false
    },
    full: {
        type: Boolean,
        default: false
    }
})
</script>

<style lang="scss" scoped>

</style>
