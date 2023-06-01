<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const props = defineProps({
    user: Object,
    dates: Object
})

console.log(props.user);
console.log(props.dates);

</script>

<template>
    <AdminLayout>

        <Head title="Edit User" />
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], [t('breadcrumbs.manage'), '/admin/manage'], [user.name, '/admin/details?id=' + user.id], [t('admin.buttons.dates'), 'Dates']]" />
        <div class="">
            <form v-for="date in dates">
                <div class="grid items-center grid-cols-2 w-1/2 mt-12">
                    <label for="id">Id</label>
                    {{ date.id }}
                    <label for="start_date">Start Date</label>
                    <input type="date" v-model="date.start_date">
                    <label for="end_date">End Date</label>
                    <input type="date" v-model="date.end_date">
                    <button class="btn btn-outline btn-success" @click="submit">{{ t('admin.buttons.save') }}</button>
                </div>
            </form>
        </div>
</AdminLayout></template>