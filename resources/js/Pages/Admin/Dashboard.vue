<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue'
    import FilesTable from '@/Shared/Info/FilesTable.vue';
    import FiltersDashboard from '@/Shared/Filters/FiltersDashboard.vue';

    const props = defineProps({
        users: Array,
    })

    console.log(props.users)
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Dashboard', '/admin']]"/>
        <div class="flex items-center mt-8">
            <FiltersDashboard/>
            <Pagination class="ml-24" :links="null"/>
        </div>
        <div class="flex justify-center">
            <FilesTable class="w-full mx-4 mt-8"/>
        </div>
    </AdminLayout>
</template>