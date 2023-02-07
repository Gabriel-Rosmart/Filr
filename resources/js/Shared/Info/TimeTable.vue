<script setup>

    const props = defineProps({
        timetable: Object
    })

    console.log(props);
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
                <tr v-for="day of timetable" class="hover">
                    <th>{{ day.day }}</th>
                    <td>{{ day.starts_at }}</td>
                    <td>{{ day.ends_at }}</td>
                    <td>{{ day.in2 }}</td>
                    <td>{{ day.out2 }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--<div>
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>start</th>
                    <th>end</th>
                    <th>range id</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="day of timetable" class="hover">
                    <th>{{ day.day }}</th>
                    <td>{{ day.starts_at }}</td>
                    <td>{{ day.ends_at }}</td>
                    <td>{{ day.date_range_id }}</td>
                </tr>
            </tbody>
        </table>
    </div>-->
</template>