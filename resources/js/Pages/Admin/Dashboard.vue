<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import QueryFilters from '@/Shared/Filters/QueryFilters.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue'
    import FilesTable from '@/Shared/Info/FilesTable.vue';
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Dashboard', '/admin']]"/>
        <div class="flex items-center mt-8">
            <QueryFilters url="/admin"/>
            <Pagination class="ml-24"/>
        </div>
        <div class="flex justify-center">
            <FilesTable class="w-full mx-4 mt-8"/>
        </div>
    </AdminLayout>
</template>