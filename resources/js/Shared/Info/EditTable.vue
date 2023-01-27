<script setup>
import { ref } from "vue"

const users = ref([
    {
        "name": "Pepe",
        "surname": "Pepez Pepez",
        "email": "pepe@pepez.ez",
        "id": 1,
        "startm": "8:10",
        "endm": "14:30",
        "startt": "16:00",
        "endt": "18:00",
        "message": "Muy guapo"
    }
])
</script>

<template>
    <div>
        <form class="hover">
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" :placeholder="users[0].name"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div>
                    <label for="name">Surname</label>
                    <input type="text" name="name" id="name" :placeholder="users[0].surname"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div>
                    <label for="name">Mail</label>
                    <input type="text" name="name" id="name" :placeholder="users[0].email"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div>
                    <p>Day</p>
                    <select class="select w-full max-w-xs">
                        <option disabled selected>Select Day</option>
                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                    </select>
                </div>
                <div>
                    <label for="start">Start Mañana</label>
                    <input type="text" name="start" id="start" :placeholder="users[0].startm"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div>
                    <label for="end">End Mañana</label>
                    <input type="text" name="end" id="end" :placeholder="users[0].endm"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div>
                    <label for="name">Start Tarde</label>
                    <input type="text" name="name" id="name" :placeholder="users[0].startt"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div>
                    <label for="name">End Tarde</label>
                    <input type="text" name="name" id="name" :placeholder="users[0].endt"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div>
                    <label for="message">Message</label>
                    <input type="text" name="message" id="message" :placeholder="users[0].message"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
<button class="btn btn-active btn-primary">Button</button>
            </div>
        </form>
    </div>
</template>