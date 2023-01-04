<script setup>
import Checkbox from '@/Components/Core/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/Core/InputError.vue';
import InputLabel from '@/Components/Core/InputLabel.vue';
import PrimaryButton from '@/Components/Core/PrimaryButton.vue';
import TextInput from '@/Components/Core/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('admin.auth.login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout dir="rtl">
        <Head title="ورود" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="tracking-tight">
            <div>
                <InputLabel for="email" value="ایمیل" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="رمز عبور" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="mr-2 text-sm text-gray-600">مرا بخاطر بسپار</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('admin.auth.password.request')" class="underline underline-offset-8 text-sm text-gray-600 hover:text-gray-900">
                    فراموشی رمز عبور
                </Link>

                <PrimaryButton class="mr-4 tracking-tighter" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    ورود به سیستم
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
