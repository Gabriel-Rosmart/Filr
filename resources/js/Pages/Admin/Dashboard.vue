<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import QueryFilters from '@/Shared/Filters/QueryFilters.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue'
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6"/>
        <div class="flex items-center mt-8">
            <QueryFilters/>
            <Pagination class="ml-24"/>
        </div>
    </AdminLayout>
</template>