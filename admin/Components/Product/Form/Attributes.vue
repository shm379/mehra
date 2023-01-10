<template>
    <div>
        <div v-for="(item,i) in attributes.filter(function (el) {
          return el.parent_id==null;
        })" :key="i">
            <component v-if="item.children && item.children.length" :is="`ui-form-attributes-${item.type}`" v-model="form.attributes" :attribute="item" />
            <component v-else :is="`ui-form-attributes-${item.type}`" v-model="form.attributes[item.id]" :attribute="item" />
        </div>
    </div>
</template>

<script setup>

    const {attributes} = useProduct()
    const props = defineProps({
        form: Object,
    });

</script>
