<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import FormEditUser from '@/Shared/Forms/FormEditUser.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const props = defineProps({
    user: Object,
    timetable: Object,
    isAdmin: Number
})

</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], [t('breadcrumbs.manage'), '/admin/manage'], [t('breadcrumbs.edit'), '/admin/edit']]" />
        <div class="flex items-center mt-8">
            <FormEditUser :user="user" :timetable="timetable" :isAdmin="isAdmin" />
        </div>
    </AdminLayout>
</template>