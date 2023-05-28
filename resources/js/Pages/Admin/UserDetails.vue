<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import TimeTable from "@/Shared/Info/TimeTable.vue";
import UserInfo from '@/Shared/User/UserInfo.vue';
import Incidents from '@/Shared/Info/IncidencesUserTable.vue';
import Permits from '@/Shared/Info/PermitsAdminTable.vue';
import EditUser from '@/Shared/Actions/EditUser.vue';
import Further from '@/Shared/User/UserFurther.vue'
import Files from '@/Shared/User/UserFiles.vue'

import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const props = defineProps({
    user: Object,
    timetable: Object,
    incidences: Array,
    permits: Array,
    files:  Object,
    filter: Object
})

const tabs = [[Files, props.files], [TimeTable, props.timetable], [Further, props.user], [Incidents, props.incidences], [Permits, props.permits]]
let currentComponentIndex = ref(0)
let url = '/admin/details?id='+ props.user.id

const fileIn = (id) => {
    let today = new Date()
    axios.post('/token', {
        user_id: props.user.id,
        time: today.toLocaleTimeString(),
        date: today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getUTCDate()
    })
        .then(function (response) { console.log(response.data); })
        .catch(function (error) { console.log(error); });
}

</script>

<template>

    <AdminLayout>

        <Head title="User Details" />

        <Breadcrumbs class="ml-5 mt-6" :pages="[['Admin', '/admin'], [t('breadcrumbs.manage'), '/admin/manage'], [user.name, '/admin/details?id=' + user.id]]" />
        <div class="flex justify-center content-center mt-4">
            <div class="flex flex-col mt-10 mx-20 w-full">
                <div class="flex items-end justify-between">
                    <UserInfo :user="user" />                    
                       <div class=" flex flex-row justify-end content-end w-1/3">
                            <button class="btn btn-outline btn-primary w-full max-w-xs mr-2"
                                @click="fileIn(user.id)">
                                Fichar
                            </button>
                        </div>
                    <EditUser class="btn-outline btn-primary" :user="user.id"/>                    
                </div>
                <div class="divider divider-vertical"></div>
                <div class="tabs mb-8">
                    <span class="tab tab-bordered" @click="currentComponentIndex = 0"
                        :class="{ 'tab-active': currentComponentIndex == 0 }">{{ t('admin.details.files') }}</span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 1"
                        :class="{ 'tab-active': currentComponentIndex == 1 }">{{ t('admin.details.timetable') }}</span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 2"
                        :class="{ 'tab-active': currentComponentIndex == 2 }">{{ t('admin.details.personal') }}</span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 3"
                        :class="{ 'tab-active': currentComponentIndex == 3 }">{{ t('admin.details.incidences') }}</span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 4"
                        :class="{ 'tab-active': currentComponentIndex == 4 }">{{ t('admin.details.permits') }}</span>
                </div>
                <div>
                    <component :is="tabs[currentComponentIndex][0]" :user="user" :timetable="timetable" :permits="permits" 
                        :incidences="incidences" :files="files" :filter="filter" :url="url"/>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>