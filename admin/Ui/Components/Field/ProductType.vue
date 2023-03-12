<template>
    <ui-switch
        label="نوع محصول" true-value="simple" true-title="ساده" false-value="multiple" false-title="ترکیبی"  v-model='type'/>
</template>

<script setup>
import {ref } from "vue"

const props = defineProps({
    modelValue: String
})
const type = ref()
</script>

<style lang="scss" scoped>

</style>
