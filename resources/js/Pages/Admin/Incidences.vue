<script setup>
    /** Component imports */
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import FiltersIncidences from '@/Shared/Filters/FiltersIncidences.vue'
    import IncidencesTable from '@/Shared/Info/IncidencesTable.vue';
    import { Head } from '@inertiajs/inertia-vue3'

    defineProps({
        incidences: Object,
        filters: Object,
    })
</script>

<template>
    <AdminLayout>

        <Head title="Incidences"/>

        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Incidences', '/admin/incidences']]"/>

        <div class="flex items-center mt-8">
            <FiltersIncidences url="/admin/incidences" :filters="filters"/>
            <Pagination class="ml-24" :links="incidences.links"/>
        </div>

        <div class="flex justify-center">
            <IncidencesTable class="w-full mx-4 mt-8" :incidences="incidences.data"/>
        </div>
    </AdminLayout>
</template>