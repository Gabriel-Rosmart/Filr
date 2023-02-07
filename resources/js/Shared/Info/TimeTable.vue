<script setup>
    import { ref } from 'vue'

    const props = defineProps({
        timetable: Object
    })

    var userWeek = {'monday': [], 'tuesday': [], 'wednesday': [], 'thursday': [], 'friday': []};

    for (const day of userWeek)
        for (const shift of props.timetable)
            if (shift.day == day)
                userWeek[day].push(shift);
    
</script>

<template>
    <div>
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>In</th>
                    <th>Out</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="day of userWeek" class="hover">
                    <th>{{ day[0].day }}</th>
                    <td>{{ day[0].starts_at }}</td>
                    <td>{{ day[0].ends_at }}</td>
                    <td>{{ day[1].starts_at }}</td>
                    <td>{{ day[1].ends_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>