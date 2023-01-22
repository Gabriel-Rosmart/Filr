<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import PermitsTable from '@/Shared/Info/PermitsTable.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
    import QueryFilters from '@/Shared/Filters/QueryFilters.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="['Admin', 'Permits']"/>
        <div class="flex items-center mt-8">
            <QueryFilters/>
            <Pagination class="ml-24"/>
        </div>
        <div class="flex justify-center">
            <PermitsTable class="w-full mx-4 mt-8"/>
        </div>
    </AdminLayout>
</template>