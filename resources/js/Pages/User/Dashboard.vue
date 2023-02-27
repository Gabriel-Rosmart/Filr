<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import UserPages from '@/Shared/Navigation/UserPages.vue';
import UserInfo from '@/Shared/User/UserInfo.vue';
import TimeTable from '@/Shared/Info/TimeTable.vue';
import PermitsTable from '@/Shared/User/UserPermits.vue';
import { ref } from 'vue';
import Incidents from '@/Shared/Info/IncidencesUserTable.vue';
import { current } from 'daisyui/src/colors';
import { useI18n } from 'vue-i18n';

const props = defineProps({
    user: Object,
    timetable: Object,
    permits: Object,
    incidents: Object,
})

const { t } = useI18n();

//const propNames = [timetable, permits];
const tabs = [TimeTable, PermitsTable, Incidents];
let currentComponentIndex = ref(0);

</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[[t('breadcrumbs.user'), '/user'], [t('breadcrumbs.dashboard'), '/user']]" />

        <div class="flex justify-center content-center mt-4">
            <div class="flex flex-col mt-10 mx-20 w-full">
                <div class="flex items-end justify-between">
                    <UserInfo class="my-8" :user="user" />
                </div>
                <div class="divider divider-vertical"></div>


                <div class="tabs mb-8">
                    <span class="tab tab-bordered" @click="currentComponentIndex = 0"
                        :class="{ 'tab-active': currentComponentIndex == 0 }">
                        {{ t('admin.details.timetable') }}
                    </span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 1"
                        :class="{ 'tab-active': currentComponentIndex == 1 }">
                        {{ t('admin.details.permits') }}
                    </span>
                    <span class="tab tab-bordered" @click="currentComponentIndex = 2"
                        :class="{ 'tab-active': currentComponentIndex == 2 }">
                        {{ t('admin.details.incidences') }}
                    </span>
                </div>
                <!-- <UserPages :activePage="'Dashboard'" class=" mt-2 mb-8" /> -->

                <!-- <PermitsTable class="my-8" :permits="permits"/> -->


                <component :is="tabs[currentComponentIndex]" :timetable="timetable" :permits="permits"
                    :incidences="incidents" />

                <!-- <TimeTable  :timetable="timetable" /> -->


            </div>
        </div>

    </UserLayout>
</template>