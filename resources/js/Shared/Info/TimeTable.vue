<script setup>
    import { ref } from "vue";

    const days = ref([
        {
            "day": "Monday",
            "in1": "08:10",
            "out1": "14:30",
            "in2": null,
            "out2": null
        },
        {
            "day": "Tuesday",
            "in1": "11:45",
            "out1": "16:30",
            "in2": null,
            "out2": null
        },
        {
            "day": "Wednesday",
            "in1": null,
            "out1": null,
            "in2": "13:50",
            "out2": "18:30"
        },
        {
            "day": "Thursday",
            "in1": "08:10",
            "out1": "14:30",
            "in2": "15:30",
            "out2": "18:30"
        },
        {
            "day": "Friday",
            "in1": "11:45",
            "out1": "16:30",
            "in2": null,
            "out2": null
        }
    ])

    const props = defineProps({
        timetable: Object
    })

    const week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    console.log(props);
</script>

<template>
    <div>
        <table class="table w-full">
            <thead>
                <tr class="hover">
                    <th>Day</th>
                    <th v-for="day of week">{{ day }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>In</th>
                </tr>
                <tr>
                    <th>Out</th>
                </tr>
                <tr>
                    <th>In</th>
                </tr>
                <tr>
                    <th>Out</th>
                </tr>
            </tbody>
        </table>
    </div>
    <!--<div>
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
    </div>-->
</template>