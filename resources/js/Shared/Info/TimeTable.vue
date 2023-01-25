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
            "in1": "08:10",
            "out1": "12:50",
            "in2": null,
            "out2": null
        },
        {
            "day": "Thursday",
            "in1": "08:10",
            "out1": "14:30",
            "in2": null,
            "out2": null
        },
        {
            "day": "Friday",
            "in1": "11:45",
            "out1": "16:30",
            "in2": null,
            "out2": null
        }
    ])
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
                <tr v-for="day of days" class="hover">
                    <th>{{ day.day }}</th>
                    <td>{{ day.in1 }}</td>
                    <td>{{ day.out1 }}</td>
                    <td>{{ day.in2 }}</td>
                    <td>{{ day.out2 }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>