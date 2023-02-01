<script setup>
    import { Link } from "@inertiajs/inertia-vue3";
    import diff from '@/Utilities/timediff'

    defineProps({
        users: Array,
    })

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
                    <td>{{ user.files[0].timestamp }}</td>
                    <td>{{ user.files[1].timestamp }}</td>
                    <td>{{ diff( user.ranges[0].schedule.starts_at, user.files[0].timestamp) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>