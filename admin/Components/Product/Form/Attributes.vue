<template>
    <div>
        <div v-for="(item,i) in form.attributes" :key="i">
            <component :is="`ui-form-attributes-${item.type}`" v-model="form.attributes[i].value" :attribute="item" />
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        form: Object,
    });

</script>
