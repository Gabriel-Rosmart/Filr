<script setup>

import { ref } from 'vue'

let isChecked = ref(false)
let selectedOption = ref('')
let options = ref([])

const props = defineProps({
    users: Array
})

console.log(props.users);
</script>

<template>
    <ul class="steps">
        <li class="step step-primary"></li>
        <li class="step"></li>
        <li class="step"></li>
    </ul>
    <div class="my-7">
        <form>
            <div class="grid grid-cols-2 ">
                <div class="mx-7 mt-4">
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Name and Surname </label>
                        <input type="text" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="email">DNI</label>
                        <input type="text" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                </div>
                <div class="mx-7 mt-4">
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Email</label>
                        <input type="email" placeholder="nombre@centro.com"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Telephone</label>
                        <input type="number" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                </div>
                <div class="mx-7 mt-4 flex">
                    <label class="cursor-pointer label">
                        <input type="checkbox" class="checkbox checkbox-secondary mr-5" v-model="isChecked" />
                        <span class="label-text">Substitute</span>
                    </label>
                </div>
                <div class="mx-7 mt-4 flex">
                    <label class="cursor-pointer label">
                        <input type="checkbox" class="checkbox checkbox-secondary mr-5" />
                        <span class="label-text">Admin</span>
                    </label>
                </div>
                <div class="mx-7 mt-4">
                    <div class="mb-4" v-show="isChecked">
                        <select class="select select-bordered">
                            <option value="" disabled selected>Teacher</option>
                            <option v-for="user of users" :key="user.id">{{ user.name }}, {{ user.id }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>