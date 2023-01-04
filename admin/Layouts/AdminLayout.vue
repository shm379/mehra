<template>
    <div class="flex gap-4 flex-row justify-start items-start" dir="rtl" lang="fa">
        <Sidebar class="sticky top-0" id="sidebar"></Sidebar>
        <section class="grow px-10">
            <slot />
        </section>
        <ui-modal />

    </div>
</template>

<script setup>
import Sidebar from "@/Layouts/Admin/Sidebar.vue";
</script>

<style lang="scss" scoped></style>
