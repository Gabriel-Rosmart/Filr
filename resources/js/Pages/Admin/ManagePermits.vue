<script setup>

    /** Component imports */
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import PermitsTable from '@/Shared/Info/PermitsTable.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import FiltersPermits from '@/Shared/Filters/FiltersPermits.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

    defineProps({
        permits: Object,
        filters: Object
    })
</script>

<template>
    <Head title="Manage Permits" />

    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], [t('breadcrumbs.permits'), '/admin/permits']]"/>

        <div class="flex items-center mt-8">
            <FiltersPermits url="/admin/permits" :filters="filters"/>
            <Pagination class="ml-24" :links="permits.links"/>
        </div>
        
        <div class="flex justify-center">
            <PermitsTable class="w-full mx-4 mt-8" :permits="permits.data"/>
        </div>
    </AdminLayout>
</template>