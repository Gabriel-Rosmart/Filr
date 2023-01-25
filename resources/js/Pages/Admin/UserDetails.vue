<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import PermitsTable from "@/Shared/Info/PermitsTable.vue";
</script>

<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="['Admin', 'Manage Users', 'User Details']" />
        <div class="flex justify-center content-center">
            <div class="flex flex-col mx-20 w-full">
                <div></div>
                <div class="divider divider-vertical"></div>
                <div>
                    <PermitsTable />
                </div>
            </div>
        </div>
        
    </AdminLayout>
</template>