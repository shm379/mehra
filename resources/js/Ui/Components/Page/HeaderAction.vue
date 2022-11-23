<template>
  <Link
    class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
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
