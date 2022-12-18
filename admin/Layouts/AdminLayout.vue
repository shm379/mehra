<template>
    <div class="flex gap-4 flex-row justify-start items-start" dir="rtl" lang="fa">
        <Sidebar ></Sidebar>
        <section class="grow px-10">
            <slot />
        </section>
    </div>
</template>

<script setup>
import Sidebar from "@/Layouts/Admin/Sidebar.vue";
</script>

<style lang="scss" scoped></style>
