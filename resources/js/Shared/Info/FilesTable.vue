<script setup>
    import { Link } from "@inertiajs/inertia-vue3";
    import getUserTimeShiftMessages from "@/Utilities/timediff";

    defineProps({
        users: Array,
    })

    const getMorningShift = (files) => {
        if(files.length >= 1) return files[0].timestamp
    }

    const getAfternoonShift = (files) => {
        if(files.length >= 2) return files[1].timestamp
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
                    <td>{{ getMorningShift(user.files) }}</td>
                    <td>{{ getAfternoonShift(user.files) }}</td>
                    <td>
                        <div class="flex justify-start">
                            <span class="ml-4" v-for="error in getUserTimeShiftMessages(user.files, user.ranges[0].schedule)">
                                {{ error }}
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>