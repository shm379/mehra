<template>
  <Head title="User" />
  <form @submit.prevent="form.post('/admin/user')">
    <div class="flex flex-row justify-between items-center h-32">
      <h3 class="text-red-500 font-bold text-lg">اطلاعات کاربری</h3>
      <Link
        class="px-3 py-3 rounded-2xl bg-neutral-100 text-sm text-slate-600 cursor-pointer hover:scale-95 delay-100 hover:ring-red-600 hover:ring-offset-stone-600 hover:shadow-lg hover:shadow-red-100 hover:ring-4 duration-200 ease-in"
        as="div"
        href="#"
        >مشاهده لیست نظرات</Link
      >
    </div>
    <div class="py-12">
      <nav class="flex border-b border-gray-100 text-sm font-medium">
        <a
          href=""
          class="-mb-px border-b border-b-4 border-red-500 font-bold border-current p-4 text-black"
        >
          اطلاعات کاربری
        </a>
      </nav>
    </div>
    <div v-if="$page.props.flash.error" class="text-red-500 border-red-500 bg-red-50 border p-5 rounded-lg mb-10 duration-1000">
        {{ $page.props.flash.error }}
    </div>
    <div v-if="$page.props.flash.success" class="text-emerald-500 border-green-500 bg-emerald-50 border p-5 rounded-lg mb-10 duration-1000">
        {{ $page.props.flash.success }}
    </div>

    <div class="flex flex-col lg:flex-row jutfiy-start items-start gap-4">
      <div class="w-full lg:w-3/4 p-5 rounded-xl bg-slate-100 grid">
        <h1 class="font-black text-neutral-600">مشخصات</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 m-5 mt-10">
          <div class="flex flex-col gap-4">
            <label class="text-sm text-slate-600">نام و نام خانوادگی</label>
            <input
              class="bg-neutral-200/50 rounded-xl outline-0 w-full p-3 focus:shadow-inner focus:shadow-slate-200 text-slate-500"
              :class="{ 'border-red-500 border bg-red-50': errors.email }"
              v-model="form.name"
            />
            <div class="text-xs text-red-600" v-if="errors.email">{{ errors.name }}</div>
          </div>
          <div class="flex flex-col gap-4">
            <label class="text-sm text-slate-600">ایمیل</label>
            <input
              class="bg-neutral-200/50 rounded-xl outline-0 w-full text-slate-500 font-mono p-3 focus:shadow-inner focus:shadow-slate-200"
              v-model="form.email"
              :class="{ 'border-red-500 border bg-red-50': errors.email }"
            />
            <div class="text-xs text-red-600" v-if="errors.email">{{ errors.email }}</div>
          </div>
          <div class="flex flex-col gap-4">
            <label class="text-sm text-slate-600">رمز عبور</label>
            <div class="relative">
              <input
                class="bg-neutral-200/50 rounded-xl outline-0 w-full text-slate-400 p-3 focus:shadow-inner focus:shadow-slate-200"
                type="password"
                v-model="form.password"
                :class="{ 'border-red-500 border bg-red-50': errors.password }"
              />
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="absolute w-6 h-6 left-5 top-3 cursor-pointer"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
            </div>
            <div class="text-xs text-red-600" v-if="errors.password">
              {{ errors.password }}
            </div>
          </div>
          <div class="flex flex-col gap-4">
            <label class="text-sm text-slate-600">تکرار رمز عبور</label>
            <div class="relative">
              <input
                class="bg-neutral-200/50 rounded-xl text-slate-400 outline-0 w-full p-3 focus:shadow-inner focus:shadow-slate-200"
                type="password"
                name="password_confirmation"
                v-model="form.password_confirmation"
                                :class="{ 'border-red-500 border bg-red-50': errors.password_confirmation }"

              />
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="absolute w-6 h-6 left-5 top-3 cursor-pointer"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
            </div>
            <div class="text-xs text-red-600" v-if="errors.password_confirmation">
                {{ errors.password_confirmation }}
            </div>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-1/4 p-5 rounded-xl bg-slate-100">
        <h3>ذخیره</h3>
        <div>
          <button
            type="submit"
            :disabled="form.processing || !form.isDirty"
            class="disabled:bg-slate-400 w-full space-x-5 py-2 text-center rounded-full bg-teal-500 text-white mt-10"
          >
            ذخیره
          </button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
  layout: AdminLayout,
};
</script>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { usePage, useForm } from "@inertiajs/inertia-vue3";
import { computed, defineProps } from "vue";
const props = defineProps({ errors: Object });
const user = computed(() => usePage().props.value.auth.user);
const form = useForm({
  email: user.value.email,
  name: user.value.name,
  password: null,
  password_confirmation: null
});
</script>
