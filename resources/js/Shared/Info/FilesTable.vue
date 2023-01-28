<script setup>
    import { Link } from "@inertiajs/inertia-vue3";

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
                    <th><Link class="dark:hover:text-cyan-400 hover:underline">{{ user.name }}</Link></th>
                    <td>{{ user.ranges[0].schedule.starts_at }}</td>
                    <td>{{ user.ranges[0].schedule.ends_at }}</td>
                    <td>{{ user.message }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>