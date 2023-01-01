<template>
    <div class="grid grid-cols-1 gap-4">
        <p :class="[{success:note.status==='SUCCESS'},{failed:note.status!=='SUCCESS'}]" :key="i" v-for="note,i in form.notes">
            {{note.note}} - ساخته شده توسط {{note.type}} - در {{note.created_at}}
        </p>
    </div>
</template>


<script setup>
const props = defineProps({
    form: Object
})
</script>

<style>
.success {
    color:green;
}
.failed {
    color:red;
}
</style>
