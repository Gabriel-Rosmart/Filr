<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue'
import UserData from '@/Components/UserData.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useI18n } from 'vue-i18n'

const { t } = useI18n();

const props = defineProps({
    user: Object,
    isAdmin: Number
})

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    dni: props.user.dni,
    telephone: props.user.phone,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    pic: ''
})

const submit = () => {
    form.post('/user/edit');
}

</script>

<template>
    <component :is="isAdmin == 0 ? UserLayout : AdminLayout">
        <Breadcrumbs v-if="isAdmin == 0" class="ml-5 mt-6" :pages="[['User', '/user'], ['Edit profile', '/user/edit']]" />
        <Breadcrumbs v-else-if="isAdmin == 1" class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], ['Edit profile', '/user/edit']]" />
        <div class="flex justify-center content-center">
            <form @submit.prevent="" class="w-full pr-10" enctype="multipart/form-data">
                <UserData :user="user" :form="form" :isAdmin="0" />
                <div class="flex justify-center mt-8">
                    <button class="btn btn-outline btn-error mr-4">{{ t('forms.cancel') }}</button>
                    <button class="btn btn-outline btn-success" @click="submit">{{ t('forms.save') }}</button>
                </div>
            </form>
        </div>

    </component>
</template>