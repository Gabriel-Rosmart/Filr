<script setup>
    import { Link } from "@inertiajs/inertia-vue3";
    import getUserTimeShiftMessages from "@/Utilities/timediff";
    import getIncidenceMessage from '@/Utilities/incidence';

    defineProps({
        users: Array,
    })

    const getMorningShift = (files) => {
        let shifts = []

        if(files.length >= 1) shifts.push(files[0].timestamp)
        if(files.length >= 3) shifts.push(files[2].timestamp)

        return shifts
    }

    const getAfternoonShift = (files) => {
        let shifts = []

        if(files.length >= 2) shifts.push(files[1].timestamp)
        if(files.length >= 4) shifts.push(files[3].timestamp)

        return shifts
    }

</script>

<template>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>In</th>
                    <th>Out</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user of users" class="hover">
                    <th><Link class="dark:hover:text-cyan-400 hover:underline" :href="'/admin/details?id=' + user.id">{{ user.name }}</Link></th>
                    <td>
                        <div class="flex flex-col">
                            <span v-for="file of getMorningShift(user.files)" class="mb-2">
                                {{ file }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span v-for="shift of getAfternoonShift(user.files)" class="mb-2">
                                {{ shift }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-start flex-col">
                            <span v-for="incidence of user.incidences" 
                                v-html="getIncidenceMessage(incidence.subject, incidence.minutes)">
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>