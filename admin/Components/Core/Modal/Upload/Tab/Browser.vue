<template>
    <div>
        <ul class="grid grid-cols-6">
            <li :key="i" v-for="(file,i) in files">

            </li>
        </ul>
        <div @click="onSelectFile(123123)">file id#1</div>
    </div>
</template>

<script setup>
import {ref} from "vue";
const emit = defineEmits(['select'])
const files = ref({})
load();
async function load() {
    files.value = await fetch("/api/v1/file-manager/").then((response) =>
        response.json()
    );
}
function onSelectFile(id) {
    selectedFile.value = id
    emit("select", selectedFile.value)
}
const selectedFile = ref([])
</script>

<style lang="scss" scoped>

</style>
