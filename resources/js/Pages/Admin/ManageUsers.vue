<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import UsersTable from '@/Shared/Info/UsersTable.vue';
</script>

<template>
    <AdminLayout>
        <div class="flex justify-center">
            <UsersTable class="w-full mx-4 mt-8"/>
        </div>
    </AdminLayout>
</template>