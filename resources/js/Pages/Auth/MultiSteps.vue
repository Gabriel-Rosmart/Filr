<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['Register', '/admin/manage/register']]" />
        <div class="w-full min-h-full flex flex-col sm:justify-center items-center sm:pt-0">
            <div class="p-5 min-h-full">
                <div class="my-6">
                    <h2 class="mb-12 text-center text-5xl font-extrabold">New User</h2>
                </div>
                <div>
                    <div v-show="currentStep === 0" class="flex flex-col items-center">
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
                                            <input type="checkbox" class="checkbox checkbox-secondary mr-5"
                                                v-model="isChecked" />
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
                                                <option v-for="user of users" :key="user.id">{{ user.name }}, {{
                                                    user.id
                                                }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div v-show="currentStep === 1" class="flex flex-col items-center">
                        <ul class="steps">
                            <li class="step step-primary"></li>
                            <li class="step step-primary"></li>
                            <li class="step"></li>
                        </ul>
                        <div class="my-7">
                            <form>
                                <div class="flex">
                                    <div class="grid grid-cols-2">
                                        <div class="mb-4 mx-7">
                                            <label class="block mb-1" for="email">Date in</label>
                                            <input type="date" placeholder="Type here"
                                                class="input input-bordered input-primary w-full max-w-xs" />
                                        </div>
                                        <div class="mb-4 mx-7">
                                            <label class="block mb-1" for="email">Date out</label>
                                            <input type="date" placeholder="Type here"
                                                class="input input-bordered input-primary w-full max-w-xs" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div v-show="currentStep === 2" class="flex flex-col items-center">
                        <ul class="steps">
                            <li class="step step-primary"></li>
                            <li class="step step-primary"></li>
                            <li class="step step-primary"></li>
                        </ul>
                        <div class="my-4 h-full">
                            <form>
                                <div class="overflow-x-auto">
                                    <table class="table w-full">
                                        <!-- head -->
                                        <thead>
                                            <tr class="">
                                                <th>Weekday</th>
                                                <th>Date In (Morning)</th>
                                                <th>Date Out (Morning)</th>
                                                <th>Date In (Afternoon)</th>
                                                <th>Date Out (Afternoon)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>Monday</th>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                            </tr>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>Tuesday</th>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                            </tr>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>Wednesday</th>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                            </tr>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>Thursday</th>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                            </tr>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>Friday</th>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                                <td><input type="text" placeholder="Type here"
                                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 justify-end mx-7">
                    <div class="mt-6">
                        <button class="btn btn-outline btn-primary" v-if="currentStep !== 0"
                            @click="currentStep--">Anterior</button>
                    </div>
                    <div class="mt-6">
                        <button class="btn btn-outline btn-primary" v-if="currentStep < 2" v-show="!isChecked"
                            @click="currentStep++">Next</button>
                    </div>
                    <div class="mt-6">
                        <button class="btn btn-primary" v-if="currentStep == 2">Send</button>
                    </div>
                    <div class="mt-6" v-show="isChecked">
                        <button class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import About from '@/Components/Steps/About.vue';
import Information from '@/Components/Steps/Information.vue';
import Profile from '@/Components/Steps/Profile.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { ref } from 'vue';

let currentStep = ref(0)
let step = ref([Information, About, Profile])


let isChecked = ref(false)
let selectedOption = ref('')
let options = ref([])

console.log(props.users);

const props = defineProps({
    users: Array
})

</script>