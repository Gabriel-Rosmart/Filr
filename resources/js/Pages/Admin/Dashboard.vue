<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import QueryFilters from '@/Shared/Filters/QueryFilters.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
</script>

<template>
    <AdminLayout>
        <div class="flex items-center mt-8">
            <QueryFilters/>
            <Pagination class="ml-24"/>
        </div>
    </AdminLayout>
</template>