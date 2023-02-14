<script setup>
import InputForm from "@/Components/InputForm.vue";
import SelectForm from "@/Components/SelectForm.vue";
import { ref } from 'vue';
import appconfig from '@/appconfig';
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    user: Object,
    timetable: Object
})
console.table(props.timetable);
console.table(props.user);

const storage = ref(appconfig.STORAGE_URL)

const weekend = [props.timetable[0], props.timetable[1], props.timetable[2], props.timetable[3], props.timetable[4]];
const shift = ['Morning', 'Afternoon'];

//Not synced with v-model
var form = useForm({
    id: props.user.id,
    name: props.user.name,
    dni: props.user.dni,
    telephone: props.user.phone,
    email: props.user.email,
});

const submit = () => {
    form.post('/admin/edit');
    console.log(form);
};

</script>


<template>
    <div class="flex items-center mt-8">
        <form @submit.prevent="">
            <div class="grid grid-cols-3">
                <div>
                    <div class=" grid grid-cols-2 w-max py-10 px-10 ">
                        <div class="grid grid-cols-2 w-max gap-6">
                            <div class="grid row-span-3 justify-center items-center">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-60 h-60">
                                        <img :src="storage + user.profile_pic" alt="Profile pic" />
                                    </div>
                                </div>
                            </div>
                            <InputForm title="Email" typ="email" v-model="form.email" :value='user.email' />
                            <InputForm title="DNI" typ="text" v-model="form.dni" :value='user.dni' />
                            <InputForm title="Phone" typ="telephone" v-model="form.telephone" :value='user.phone' />
                            <SelectForm title="Role" :data='3' :rol="user.role_id" />
                            <InputForm title="Name" typ="text" v-model="form.name" :value='user.name' />
                        </div>
                        <div>
                            <table class="table w-full">
                                <thead>
                                    <tr class="">
                                        <th></th>
                                        <th>In (Morning)</th>
                                        <th>Out (Morning)</th>
                                        <th>In (Afternoon)</th>
                                        <th>Out (Afternoon)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="day in weekend">
                                        <th>{{ day.day }}</th>
                                        <td>
                                            <InputForm typ="time" :value='day.starts_at' />
                                        </td>
                                        <td>
                                            <InputForm typ="time" :value='day.ends_at' />
                                        </td>
                                        <td>
                                            <InputForm typ="time" :value='day.starts_at' />
                                        </td>
                                        <td>
                                            <InputForm typ="time" :value='day.ends_at' />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-end mt-8">
                        <button class="btn btn-outline btn-error mr-4">Cancel</button>
                        <button class="btn btn-outline btn-success" @click="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>