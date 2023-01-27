<script setup>
import { ref } from "vue"

const users = ref([
    {
        "name": "John",
        "id": 1,
        "start": "8:10",
        "end": "14:30",
        "message": null
    },
    {
        "name": "Jake",
        "id": 2,
        "start": "11:45",
        "end": "16:30",
        "message": null
    },
    {
        "name": "Trudy",
        "id": 3,
        "start": "8:10",
        "end": "12:50",
        "message": "Is late"
    }
])
</script>

<template>
    <div class="overflow-x-auto">
        <form v-for="user of users" class="hover">
            <div v-if="user.id == 3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" :placeholder="user.name"
                    class="border border-gray-300 rounded-md p-2 w-full">
                <label for="start">Start</label>
                <input type="time" name="start" id="start" :placeholder="user.start"
                    class="border border-gray-300 rounded-md p-2 w-full">
                <label for="end">End</label>
                <input type="time" name="end" id="end" :placeholder="user.end"
                    class="border border-gray-300 rounded-md p-2 w-full">
                <label for="message">Message</label>
                <input type="text" name="message" id="message" :placeholder="user.message"
                    class="border border-gray-300 rounded-md p-2 w-full">
                <button class="btn-primary">Save</button>
            </div>
        </form>
    </div>
</template>