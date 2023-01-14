<script setup>
    import { ref } from "vue"
    import { Link } from "@inertiajs/inertia-vue3";

    const users = ref([
        {
            "name": "John",
            "start": "8:10",
            "end": "14:30",
            "message": null
        },
        {
            "name": "Jake",
            "start": "11:45",
            "end": "16:30",
            "message": null
        },
        {
            "name": "Trudy",
            "start": "8:10",
            "end": "12:50",
            "message": "Is late"
        }
    ])
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
                    <td>{{ user.start }}</td>
                    <td>{{ user.end }}</td>
                    <td>{{ user.message }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>