<script setup>
    import { ref } from 'vue'
    import { useI18n } from 'vue-i18n';

    const { t } = useI18n();

    const props = defineProps({
        timetable: Object
    })

    const week = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    var userWeek = [[], [], [], [], []];

    for (const day of week)
        for (const shift of props.timetable)
            if (shift.day == day)
                userWeek[week.indexOf(day)].push(shift);
    console.table(userWeek);
    
</script>

<template>
    <div v-if="timetable.length > 0">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>{{ t('days.day') }}</th>
                    <th>{{ t('table.in') }}</th>
                    <th>{{ t('table.out') }}</th>
                    <th>{{ t('table.in') }}</th>
                    <th>{{ t('table.out') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="day of userWeek" class="hover">
                    <th v-if="day[0] != undefined" >{{ t('days.' + day[0].day) }}</th>
                    <td v-else></td>
                    <td v-if="day[0] != undefined" >{{ day[0].starts_at }}</td>
                    <td v-else></td>
                    <td v-if="day[0] != undefined" >{{ day[0].ends_at }}</td>
                    <td v-else></td>
                    <td v-if="day[1] != undefined" >{{ day[1].starts_at }}</td>
                    <td v-else></td>
                    <td v-if="day[1] != undefined" >{{ day[1].ends_at }}</td>
                    <td v-else></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="overflow-x-auto w-full" v-else>
        <div class="alert alert-error shadow-lg">
            <div>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-current flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg> -->
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <span>{{ t('admin.details.noTimetable') }}</span>
            </div>
        </div>
    </div>
</template>