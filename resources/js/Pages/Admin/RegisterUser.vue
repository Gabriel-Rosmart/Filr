<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue'
import RegisterForm from '@/Shared/Actions/RegisterForm.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const props = defineProps({
        users: Array,
        roles: Array
})
</script>

<template>
    <Head title="Register"/>
    <AdminLayout>
        <Breadcrumbs 
            class="ml-5 mt-6"
            :pages="[[ t('breadcrumbs.admin'), '/admin'], [t('breadcrumbs.manage'), '/admin/manage'], [t('breadcrumbs.register'), '/admin/manage/register']]" 
        />
        <RegisterForm :users="users" :roles="roles" />
    </AdminLayout>
</template>