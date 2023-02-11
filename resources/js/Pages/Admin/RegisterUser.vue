<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue'
import RegisterForm from '@/Shared/Actions/RegisterForm.vue';
</script>

<template>
    <AdminLayout>
        <Breadcrumbs 
            class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['Register', '/admin/manage/register']]" 
        />
        <RegisterForm/>
    </AdminLayout>
</template>