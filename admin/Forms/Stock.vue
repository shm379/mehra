<template>
    <div class="grid grid-cols-1 gap-8">
        <ui-field-switch label="نوع" trueTitle="اتوماتیک" falseTitle="دستی"  trueValue="1" falseValue="2" v-model="form.type"></ui-field-switch>
        <ui-row>
          <ui-col wide>
            <ui-input
                label="عنوان انبار"
                :errors="errors"
                v-model="form.title"
                error="title"
            ></ui-input>
          </ui-col>
          <ui-col wide>
            <ui-autocomplete-city label="شهر" v-model="stock" >
            </ui-autocomplete-city>
          </ui-col>
        </ui-row>
        <ui-row>
          <ui-col>
            <ui-field-select :options="[
                {
                  label:'بدون اولویت',
                },
                {
                  label:'1',
                  value:1,
                },
                {
                  label:'2',
                  value:2,
                },
                {
                  label:'3',
                  value:3,
                },
            ]" label="اولویت انبار" v-model="form.priority" >
            </ui-field-select>
          </ui-col>
        </ui-row>
    </div>
</template>

<script setup>


import {defineProps} from "vue";

const props = defineProps({
    form: Object
})
// const cities = defineProps({
  
// });
// this.loadCities();
</script>

<style lang="scss" scoped>

</style>
