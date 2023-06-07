<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FormEditUser from '@/Shared/Forms/FormEditUser.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const props = defineProps({
    user: Object,
    timetable: Object,
    isAdmin: Number,
    dates: Object,
    range : Number
})

console.log(props.dates);

</script>

<template>
    <AdminLayout>
        <Head title="Edit User" />
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], [t('breadcrumbs.manage'), '/admin/manage'],[props.user.name, '/admin/details?id=' + props.user.id],[t('breadcrumbs.edit'), '/admin/edit']]" />
        <div class="flex items-center mt-8">
            <FormEditUser :user="user" :timetable="timetable" :isAdmin="isAdmin" :dates="dates" :range="range"/>
        </div>
    </AdminLayout>
</template>