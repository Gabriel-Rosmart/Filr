<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="['Admin', 'Manage Users', 'User Details']"/>

    </AdminLayout>
</template>