<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import TimeTable from "@/Shared/Info/TimeTable.vue";
import UserInfo from '@/Shared/User/UserInfo.vue';

const props = defineProps({
    user: Array
})
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['User Details', '/admin/details']]" />
        <div class="flex justify-center content-center">
            <div class="flex flex-col mt-10 mx-20 w-full">
                <div>
                    <UserInfo :user="user"/>
                </div>
                <div class="divider divider-vertical"></div>
                <div>
                    <TimeTable />
                </div>
            </div>
        </div>
        
    </AdminLayout>
</template>