<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import TimeTable from "@/Shared/Info/TimeTable.vue";
import UserInfo from '@/Shared/User/UserInfo.vue';

import { Head } from '@inertiajs/inertia-vue3';

import TestTable from '@/Shared/Info/TestTable.vue'
import { ref } from 'vue'

const props = defineProps({
    user: Array
})

const tabs = [TimeTable, TestTable]
let currentComponentIndex = ref(0)

</script>

<template>
    <Head title="User Details" />
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['User Details', '/admin/details']]" />
        <div class="flex justify-center content-center">
            <div class="flex flex-col mt-10 mx-20 w-full">
                <div>
                    <UserInfo :user="user"/>
                </div>
                <div class="divider divider-vertical"></div>
                <div class="tabs mb-8">
                    <span class="tab tab-bordered" @click="currentComponentIndex = 0" :class="{'tab-active': currentComponentIndex == 0}">Horarios</span> 
                    <span class="tab tab-bordered" @click="currentComponentIndex = 1" :class="{'tab-active': currentComponentIndex == 1}">Datos Personales</span> 
                </div>
                <div>
                    <component :is="tabs[currentComponentIndex]"/>
                </div>
            </div>
        </div>    
    </AdminLayout>
</template>