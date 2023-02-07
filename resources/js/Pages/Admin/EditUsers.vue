<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import FormEditUser from '@/Shared/Forms/FormEditUser.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['Edit User', '/admin/edit']]"/>
        <div class="flex items-center mt-8">
            <FormEditUser/>
        </div>
    </AdminLayout>
</template>