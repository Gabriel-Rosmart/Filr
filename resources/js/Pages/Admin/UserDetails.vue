<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import TimeTable from "@/Shared/Info/TimeTable.vue";
import UserInfo from '@/Shared/User/UserInfo.vue';
import Incidents from '@/Shared/Info/IncidencesUserTable.vue';
import EditUser from '@/Shared/Actions/EditUser.vue';

import { Head } from '@inertiajs/inertia-vue3';

import Further from '@/Shared/User/UserFurther.vue'
import { ref } from 'vue'

const props = defineProps({
    user: Object,
    timetable: Object,
    incidences: Array
})

const tabs = [TimeTable, Further, Incidents]
let currentComponentIndex = ref(0)

</script>

<template>

    <Head title="User Details" />
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], [user.name, '/admin/details?id=' + user.id]]" />
        <div class="flex justify-center content-center">
            <div class="flex flex-col mt-10 mx-20 w-full">
                <div class="mr-8 w-full flex justify-end">
                    <EditUser class="btn-outline btn-primary" :user="user.id"/>
                </div>
                <div>
                    <UserInfo :user="user" />
                </div>
                <div class="divider divider-vertical"></div>
                <div class="tabs mb-8">
                    <span class="tab tab-bordered" @click="currentComponentIndex = 0"
                        :class="{ 'tab-active': currentComponentIndex == 0 }">Horarios</span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 1"
                        :class="{ 'tab-active': currentComponentIndex == 1 }">Datos Personales</span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 2"
                        :class="{ 'tab-active': currentComponentIndex == 2 }">Incidentes</span>
                </div>
                <div>
                    <component :is="tabs[currentComponentIndex]" :timetable="timetable" :user="user" :incidences="incidences"/>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>