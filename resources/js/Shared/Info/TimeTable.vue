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
    <div>
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
</template>