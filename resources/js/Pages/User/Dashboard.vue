<script setup>

/* Components */
import UserLayout from '@/Layouts/UserLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import UserInfo from '@/Shared/User/UserInfo.vue';
import TimeTable from '@/Shared/Info/TimeTable.vue';
import PermitsTable from '@/Shared/User/UserPermits.vue';
import Incidents from '@/Shared/Info/IncidencesUserTable.vue';
import Files from '@/Shared/User/UserFiles.vue'

/* VUE parameters */
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import axios from 'axios';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
    user: Object,
    timetable: Object,
    permits: Object,
    incidents: Object,
    files: Object,
    componentIndex: Number,
    filter: Object
})

const fileIn = (id) => {
    axios.post('/token', {
        token: id
    })
        .then(function (response) { console.log(response.data); })
        .catch(function (error) { console.log(error); });
}

const { t } = useI18n();

//const propNames = [timetable, permits];
const tabs = [TimeTable, Files, PermitsTable, Incidents];

let currentComponentIndex = ref(0)
if (props.componentIndex != null) {
    currentComponentIndex = ref(props.componentIndex);
}


</script>

<template>
    <Head title="Inicio" />
    <component :is="user.is_admin == 0 ? UserLayout : AdminLayout">
        <Breadcrumbs v-if="user.is_admin == 0" class="ml-5 mt-6"
            :pages="[[t('breadcrumbs.user'), '/user'], [t('breadcrumbs.dashboard'), '/user']]" />
        <Breadcrumbs v-else-if="user.is_admin == 1" class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], [t('breadcrumbs.dashboard'), '/user']]" />
        <div class="flex justify-center content-center mt-4">
            <div class="flex flex-col mt-10 mx-20 w-full">
                <div class="flex items-end justify-between">
                    <UserInfo class="my-8" :user="user" />
                    <div class="flex justify-end w-1/3">
                        <button class="btn btn-outline btn-primary w-full max-w-xs my-12 mr-2"
                            @click="fileIn(user.id)">Fichar</button>
                    </div>
                </div>
                <div class="divider divider-vertical"></div>


                <div class="tabs mb-8">
                    <span class="tab tab-bordered" @click="currentComponentIndex = 0"
                        :class="{ 'tab-active': currentComponentIndex == 0 }">
                        {{ t('admin.details.timetable') }}
                    </span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 1"
                        :class="{ 'tab-active': currentComponentIndex == 1 }">
                        {{ t('admin.details.files') }}
                    </span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 2"
                        :class="{ 'tab-active': currentComponentIndex == 2 }">
                        {{ t('admin.details.permits') }}
                    </span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 3"
                        :class="{ 'tab-active': currentComponentIndex == 3 }">
                        {{ t('admin.details.incidences') }}
                    </span>
                </div>

                <component :is="tabs[currentComponentIndex]" :timetable="timetable" :permits="permits"
                    :incidences="incidents" :files="files" :filter="filter"/>

            </div>
        </div>

    </component>
</template>