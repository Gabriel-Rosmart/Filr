<script setup>
    /** Component imports */
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import IncidencesTable from '@/Shared/Info/IncidencesTable.vue';

    defineProps({
        incidences: Array
    })
</script>

<template>
    <AdminLayout>
        <div class="flex justify-center">
            <IncidencesTable class="w-full mx-4 mt-8" :incidences="incidences"/>
        </div>
    </AdminLayout>
</template>