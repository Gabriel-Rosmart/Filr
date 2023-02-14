<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import FormEditUser from '@/Shared/Forms/FormEditUser.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const props = defineProps({
    user: Object,
    timetable: Object
})

</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['Edit User', '/admin/edit']]"/>
        <div class="flex items-center mt-8">
            <FormEditUser :user="user" :timetable="timetable"/>
        </div>
    </AdminLayout>
</template>