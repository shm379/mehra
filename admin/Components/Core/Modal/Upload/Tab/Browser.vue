<template>
    <div>
        <div @click="onSelectFile(123123)">file id#1</div>
    </div>
</template>

<script setup>
import {ref} from "vue";
const emit = defineEmits(['select'])
function onSelectFile(id) {
    selectedFile.value = id
    emit("select", selectedFile.value)
}
const selectedFile = ref('ss')
</script>

<style lang="scss" scoped>

</style>
