<template>
    <div :key="key" class="h-screen w-screen bg-black/30 fixed z-50 right-0 left-0 top-0 bottom-0 " v-if="modals && modals[0]">
        <ui-modal-ui @ok="m.onOk"  @close="onClose(i)" v-for="m,i in modals" :option="m" :key="i" >
            {{m}}

        </ui-modal-ui>
    </div>
</template>

<script setup>
import {watch, ref} from "vue"
const {modals, onClose} = useModal()
const key = ref(1)
watch(modals, () => key.value = key.value +1)
</script>

<style lang="scss" scoped>

</style>
