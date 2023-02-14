<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue'
import RegisterForm from '@/Shared/Actions/RegisterForm.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
        users: Array
})
</script>

<template>
    <Head title="Register"/>
    <AdminLayout>
        <Breadcrumbs 
            class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['Register', '/admin/manage/register']]" 
        />
        <RegisterForm :users="users"/>
    </AdminLayout>
</template>