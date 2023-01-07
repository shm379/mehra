<template>
  <div class="flex items-center justify-between my-[24px]">
      <p class="text-base text-gray-800">اسلایدها (حداقل ۲ و حداکثر ۷ اسلاید)</p>
      <button class="text-red-500 text-base">
          افزودن اسلاید
      </button>
  </div>
  <div class="mb-[10px] bg-white rounded-[15px] p-[23px] flex flex-col gap-4 ">
         <div class="flex flex-row gap-2 items-stretch">
             <ui-col fit class="flex">
                 <div class="flex align-items-center justify-center">
                     <button>=</button>
                 </div>
             </ui-col>
             <ui-col full class="flex justify-center items-center">
                 <ui-upload class="ml-[12px] "></ui-upload>
                 <ui-upload></ui-upload>
             </ui-col>
             <ui-col full>
                 <ui-input label="عنوان" v-model="newSlider"></ui-input>
                 <ui-input label="توضیحات" v-model="newDescription"></ui-input>
                 <ui-input label="انتخاب رنگ زمینه" v-model="newDescription"></ui-input>
             </ui-col>
             <ui-col fit class="flex ">
                 <div class="flex align-items-center justify-center">
                     <button>-</button>
                 </div>
             </ui-col>
         </div>
    <div
      class="flex w-full  flex-row gap-2 items-center  justify-between"
      v-for="(item, i) in sliders"
      :key="i"
    >
      <div class="w-5/12 ">
        <ui-input label="عنوان" v-model="item.slider"></ui-input>
      </div>
      <div class="w-6.12 bg-blue-400 p-5">
        <ui-input label="توضیحات" v-model="item.description"></ui-input>
      </div>
      <div
        class="w-1/12 flex flex-row cursor-pointer justify-start items-center"
        @click="remove(i)"
      >
        <svg
          width="21"
          height="2"
          viewBox="0 0 21 2"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M1.23917 1.375H19.9892C20.1767 1.375 20.3642 1.23438 20.3642 1.04688C20.3642 0.8125 20.1767 0.625 19.9892 0.625H1.23917C1.0048 0.625 0.864173 0.8125 0.864173 1.04688C0.864173 1.23438 1.0048 1.375 1.23917 1.375Z"
            fill="#A3A3A3"
          />
        </svg>
      </div>
    </div>
<!--    <div class="flex flex-row gap-2 items-end">-->
<!--            <div class="w-6/12">-->

<!--            </div>-->
<!--            <div class="w-6/12">-->
<!--                <ui-input label="عنوان" v-model="newSlider"></ui-input>-->
<!--                <ui-input label="توضیحات" v-model="newDescription"></ui-input>-->
<!--            </div>-->
<!--            <div-->
<!--                class="w-1/12 flex flex-row cursor-pointer justify-start items-center"-->
<!--                @click="add"-->
<!--            >-->
<!--                <svg-->
<!--                    width="30"-->
<!--                    height="31"-->
<!--                    viewBox="0 0 30 31"-->
<!--                    fill="none"-->
<!--                    xmlns="http://www.w3.org/2000/svg"-->
<!--                >-->
<!--                    <path-->
<!--                        d="M29.875 15.5C29.875 15.8516 29.5938 16.0625 29.3125 16.0625H15.8125V29.5625C15.8125 29.9141 15.5312 30.1953 15.25 30.1953C14.8984 30.1953 14.6875 29.9141 14.6875 29.5625V16.0625H1.1875C0.835938 16.0625 0.625 15.8516 0.625 15.5703C0.625 15.2188 0.835938 14.9375 1.1875 14.9375H14.6875V1.4375C14.6875 1.15625 14.8984 0.945312 15.25 0.945312C15.5312 0.945312 15.8125 1.15625 15.8125 1.4375V14.9375H29.3125C29.5938 14.9375 29.875 15.2188 29.875 15.5Z"-->
<!--                        fill="#A3A3A3"-->
<!--                    />-->
<!--                </svg>-->
<!--            </div>-->
<!--        </div>-->
  </div>
  <div class="bg-white rounded-[15px] p-[23px] flex flex-col gap-4 ">
         <div class="flex flex-row gap-2 items-stretch">
             <ui-col fit class="flex">
                 <div class="flex align-items-center justify-center">
                     <button>=</button>
                 </div>
             </ui-col>
             <ui-col full class="flex justify-center items-center">
                 <ui-upload class="ml-[12px] "></ui-upload>
                 <ui-upload></ui-upload>
             </ui-col>
             <ui-col full>
                 <ui-input label="عنوان" v-model="newSlider"></ui-input>
                 <ui-input label="توضیحات" v-model="newDescription"></ui-input>
                 <ui-input label="انتخاب رنگ زمینه" v-model="newDescription"></ui-input>
             </ui-col>
             <ui-col fit class="flex ">
                 <div class="flex align-items-center justify-center">
                     <button>-</button>
                 </div>
             </ui-col>
         </div>
    <div
      class="flex w-full  flex-row gap-2 items-center  justify-between"
      v-for="(item, i) in sliders"
      :key="i"
    >
      <div class="w-5/12 ">
        <ui-input label="عنوان" v-model="item.slider"></ui-input>
      </div>
      <div class="w-6.12 bg-blue-400 p-5">
        <ui-input label="توضیحات" v-model="item.description"></ui-input>
      </div>
      <div
        class="w-1/12 flex flex-row cursor-pointer justify-start items-center"
        @click="remove(i)"
      >
        <svg
          width="21"
          height="2"
          viewBox="0 0 21 2"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M1.23917 1.375H19.9892C20.1767 1.375 20.3642 1.23438 20.3642 1.04688C20.3642 0.8125 20.1767 0.625 19.9892 0.625H1.23917C1.0048 0.625 0.864173 0.8125 0.864173 1.04688C0.864173 1.23438 1.0048 1.375 1.23917 1.375Z"
            fill="#A3A3A3"
          />
        </svg>
      </div>
    </div>
<!--    <div class="flex flex-row gap-2 items-end">-->
<!--            <div class="w-6/12">-->

<!--            </div>-->
<!--            <div class="w-6/12">-->
<!--                <ui-input label="عنوان" v-model="newSlider"></ui-input>-->
<!--                <ui-input label="توضیحات" v-model="newDescription"></ui-input>-->
<!--            </div>-->
<!--            <div-->
<!--                class="w-1/12 flex flex-row cursor-pointer justify-start items-center"-->
<!--                @click="add"-->
<!--            >-->
<!--                <svg-->
<!--                    width="30"-->
<!--                    height="31"-->
<!--                    viewBox="0 0 30 31"-->
<!--                    fill="none"-->
<!--                    xmlns="http://www.w3.org/2000/svg"-->
<!--                >-->
<!--                    <path-->
<!--                        d="M29.875 15.5C29.875 15.8516 29.5938 16.0625 29.3125 16.0625H15.8125V29.5625C15.8125 29.9141 15.5312 30.1953 15.25 30.1953C14.8984 30.1953 14.6875 29.9141 14.6875 29.5625V16.0625H1.1875C0.835938 16.0625 0.625 15.8516 0.625 15.5703C0.625 15.2188 0.835938 14.9375 1.1875 14.9375H14.6875V1.4375C14.6875 1.15625 14.8984 0.945312 15.25 0.945312C15.5312 0.945312 15.8125 1.15625 15.8125 1.4375V14.9375H29.3125C29.5938 14.9375 29.875 15.2188 29.875 15.5Z"-->
<!--                        fill="#A3A3A3"-->
<!--                    />-->
<!--                </svg>-->
<!--            </div>-->
<!--        </div>-->
  </div>
    <button class="bg-transparent text-red-500 h-[64px] justify-center items-center flex w-full text-base ">+ افزودن اسلاید</button>
</template>

<script setup>
import { computed, ref } from "vue";
const props = defineProps({
  form: Object,
});
const newSlider = ref();
const newDescription = ref();
const sliders = computed({
  get: () => props.form.sliders,
  set(v) {
    var mv = props.form;
    mv.sliders = v;
    emit("update:form", mv);
  },
});
function add() {
  sliders.value.push({
      mobile_image: null,
      desktop_image: null,
      description: newDescription.value,
  });
  newSlider.value = null;
  newDescription.value = null;
}

function remove(i) {
  sliders.value.splice(i, 1);
}
</script>

<style lang="scss" scoped></style>
