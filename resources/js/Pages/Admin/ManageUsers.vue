<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import UsersTable from '@/Shared/Info/UsersTable.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="['Admin', 'Manage Users']"/>
        <div class="flex justify-center">
            <UsersTable class="w-full mx-4 mt-8"/>
        </div>
    </AdminLayout>
</template>