<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import UsersTable from '@/Shared/Info/UsersTable.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
    import CreateUser from '@/Shared/Actions/CreateUser.vue';
    import QueryFilters from '@/Shared/Filters/QueryFilters.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';

    defineProps({
        users: Array
    })
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="['Admin', 'Manage Users']"/>
        <div class="flex items-center mt-8">
            <QueryFilters/>
            <Pagination class="ml-24"/>
            <div class="mr-8 w-full flex justify-end">
                <CreateUser class="btn-outline btn-primary"/>
            </div>
        </div>
        <div class="flex justify-center">
            <UsersTable class="w-full mx-4 mt-8" :users="users"/>
        </div>
    </AdminLayout>
</template>