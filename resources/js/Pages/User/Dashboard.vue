<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import UserPages from '@/Shared/Navigation/UserPages.vue';
import UserInfo from '@/Shared/User/UserInfo.vue';
import TimeTable from '@/Shared/Info/TimeTable.vue';
import PermitsTable from '@/Shared/Info/PermitsTable.vue';
import { ref } from 'vue';
import { current } from 'daisyui/src/colors';

const props = defineProps({
    user: Object,
    timetable: Object,
    permits: Object,
})

//const propNames = [timetable, permits];
const tabs = [TimeTable, PermitsTable];
let currentComponentIndex = ref(0);

</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['User', '/user'], ['Dashboard', '/user']]" />

        <div class="flex justify-center content-center">
            <div class="container">
                <div class="flex-column">
                    <UserInfo class="my-8" :user="user" />
                    <div class="flex justify-center content-center">

                        <div class="tabs my-8">
                            <span class="tab tab-bordered" @click="currentComponentIndex = 0"
                                :class="{ 'tab-active': currentComponentIndex == 0 }">
                                Horario
                            </span>
                            <span class="tab tab-bordered" @click="currentComponentIndex = 1"
                                :class="{ 'tab-active': currentComponentIndex == 1 }">
                                Permisos
                            </span>
                            <span class="tab tab-bordered" @click="currentComponentIndex = 2"
                                :class="{ 'tab-active': currentComponentIndex == 2 }">
                                Incidencias
                            </span>
                        </div>
                        <!-- <UserPages :activePage="'Dashboard'" class=" mt-2 mb-8" /> -->

                        <!-- <PermitsTable class="my-8" :permits="permits"/> -->
                    </div>

                    <component class="my-8" :is="tabs[currentComponentIndex]" :timetable="timetable" />

                    <!-- <TimeTable  :timetable="timetable" /> -->
                </div>

            </div>
        </div>

    </UserLayout>
</template>