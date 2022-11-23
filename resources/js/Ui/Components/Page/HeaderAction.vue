<template>
  <Link
    class="page-header-action"
    as="div"
    :href="route(to)"
    ><slot></slot
  ></Link>
 </template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
  to: String,
});
</script>
