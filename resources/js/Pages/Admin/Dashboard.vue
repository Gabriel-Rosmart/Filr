<script setup>

    /** Component imports */
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue'
    import FilesTable from '@/Shared/Info/FilesTable.vue';
    import FiltersDashboard from '@/Shared/Filters/FiltersDashboard.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

    const props = defineProps({
        users: Object,
        filters: Object,
        roles: Array,
    })

</script>

<template>
    <Head title="Dashboard" />
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], [t('breadcrumbs.dashboard'), '/admin']]"/>

        <div class="flex md:flex-wrap items-center mt-8 gap-4">
            <FiltersDashboard url="/admin" :filters="filters" :roles="roles"/>
            <Pagination class="ml-24 lg:mt-8 xl:mt-0" :links="users.links"/>
        </div>

        <div class="flex justify-center">
            <FilesTable class="w-full mx-4 mt-8" :users="users.data"/>
        </div>
    </AdminLayout>
</template>