<script setup>

    const props = defineProps({
        timetable: Object
    })

    const week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    console.log(props);
</script>

<template>
    <!-- <div>
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
    </div> -->
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
</template>