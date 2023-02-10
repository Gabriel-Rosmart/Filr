<script setup>

    /** Component imports */
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import UsersTable from '@/Shared/Info/UsersTable.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
    import CreateUser from '@/Shared/Actions/CreateUser.vue';
    import FiltersUsers from '@/Shared/Filters/FiltersUsers.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

    defineProps({
        users: Object,
        filters: Object
    })
</script>

<template>
    <Head title="Manage Users" />

    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], [t('breadcrumbs.manage'), '/admin/manage']]"/>

        <div class="flex items-center mt-8">
            <FiltersUsers url="/admin/manage" :filters="filters"/>
            <Pagination class="ml-24" :links="users.links"/>
            <div class="mr-8 w-full flex justify-end">
                <CreateUser class="btn-outline btn-primary"/>
            </div>
        </div>
        
        <div class="flex justify-center">
            <UsersTable class="w-full mx-4 mt-8" :users="users.data" :filters="filters"/>
        </div>
    </AdminLayout>
</template>