<template>
    <div v-if="form.type">
        <component v-if="componentName" :is="componentName" :form="form"></component>
    </div>
</template>


<script setup>
import {ref ,computed } from "vue"

import attributeType from "@/Definitions/attribute-types"


const componentName = computed(() => values.value.find(v => v.value == props.form.type).component || false)
const props = defineProps({
    form: Object
})
const value = ref()
const values = ref(attributeType)
</script>

<style lang="scss" scoped>

</style>
