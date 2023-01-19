<script setup>
import FormLabel from '@/Shared/Forms/FormLabel.vue'
import FormTextInput from '@/Shared/Forms/FormTextInput.vue'
import FormInputError from '@/Shared/Forms/FormInputError.vue'
import FormCheckbox from '@/Shared/Forms/FormCheckbox.vue'
import FormPrimaryButton from '@/Shared/Forms/FormPrimaryButton.vue'
import LoginLayout from '@/Layouts/LoginLayout.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

import { onMounted } from 'vue'

import { getMediaPreference, setTheme, getTheme } from "@/Shared/Navigation/Theme"

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

onMounted(() => {
    const initUserTheme = getTheme() || getMediaPreference()
    setTheme(initUserTheme)
})
</script>

<template>
    <LoginLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <FormLabel for="email" value="Email" />

                <FormTextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="username" />

                <FormInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <FormLabel for="password" value="Password" />

                <FormTextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="current-password" />

                <FormInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <FormCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 label">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="underline text-sm dark:text-cyan-500 dark:hover:text-cyan-600 hover:text-black rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Forgot your password?
                </Link>

                <FormPrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </FormPrimaryButton>
            </div>
        </form>
    </LoginLayout>
</template>