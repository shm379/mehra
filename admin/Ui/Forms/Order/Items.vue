<template>
    <div class="flex flex-col">
        <table class="min-w-full">
            <thead class="bg-white border-b">
                <tr>
                    <th></th>
                    <th></th>
                    <th>برند٬تولیدکننده٬ناشر</th>
                    <th>تعداد</th>
                    <th>قیمت تکی</th>
                    <th>قیمت کل</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in form.items">
                    <td style="width: 100px">
                        <img :src="item.image" width="100">
                    </td>
                    <td class="text-center w-[200px]">
                       <h2 class="font-bold">{{item.title}}</h2>
                       <p>{{item.sub_title}}</p>
                    </td>
                    <td class="text-center">
                      {{item.producer.title}}
                    </td>
                    <td class="text-center">
                      {{item.number}}
                    </td>
                    <td class="text-center">
                      {{item.price}}
                    </td>
                    <td class="text-center">
                      {{item.total}}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script setup>
const props = defineProps({
    form: Object
})
</script>

<style scoped>

</style>
