<template>
    <div v-if="form.type">
        <component v-if="componentName" :is="componentName" :form="form"></component>
    </div>
</template>

<script>
import UiFormAttributeValueMulti from "@/Components/Ui/Form/Attribute/Value/Multi.vue"
export default {
    components: {
        UiFormAttributeValueMulti
    }
}
</script>

<script setup>
import {ref ,computed } from "vue"

import attributeType from "@/definitions/attribute-types"


const componentName = computed(() => values.value.find(v => v.value == props.form.type).component || false)
const props = defineProps({
    form: Object
})
const value = ref()
const values = ref(attributeType)
</script>

<style lang="scss" scoped>

</style>
