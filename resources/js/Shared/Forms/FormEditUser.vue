<script setup>
import UserData from "@/Components/UserData.vue";
import UserTimes from "@/Components/UserTimes.vue";
import { useForm } from '@inertiajs/inertia-vue3'

import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const props = defineProps({
    user: Object,
    timetable: Object,
    isAdmin: Number
})
console.table(props.timetable);

const weekend = [props.timetable[0], props.timetable[1], props.timetable[2], props.timetable[3], props.timetable[4]];
const shift = ['Morning', 'Afternoon'];

var form = useForm({
    id: props.user.id,
    name: props.user.name,
    dni: props.user.dni,
    telephone: props.user.phone,
    email: props.user.email,
});

var date = useForm({
    starts_at: props.timetable.starts_at,
    ends_at: props.timetable.ends_at

});

const submit = () => {
    form.post('/admin/edit');
    console.log(form);
};


</script>


<template>
    <div class="flex items-center w-full mt-8">
    <form @submit.prevent="" class="w-full pr-10">
        <div class="grid grid-cols-2 w-auto">
            <UserData :user="user" :form="form" :isAdmin="isAdmin" />
            <!---
                        <div class=" grid justify-items-center py-10 pl-10 ">
                            <div class="grid grid-cols-2 w-max gap-6">
                                <div class="grid row-span-3 justify-center items-center">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-60 h-60">
                                            <img :src="storage + user.profile_pic" alt="Profile pic" />
                                            </div>
                                                    </div>
                                                </div>
                                                <InputForm title="Email" type="email" v-model="form.email" :value='user.email' />
                                                <InputForm title="DNI" type="text" v-model="form.dni" :value='user.dni' />
                                                <InputForm title="Phone" type="telephone" v-model="form.telephone" :value='user.phone' />
                                                <SelectForm title="Role" :data='3' :rol="user.role_id" />
                                                <InputForm title="Name" type="text" v-model="form.name" :value='user.name' />
                                            </div>
                                        </div>-->
                <UserTimes :weekend="weekend" :shift="shift" />
                <!--
                                        <div class="flex justify-center">
                                            <table class="table w-max">
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
                                                            <InputForm type="time" :value='day.starts_at' />
                                                        </td>
                                                        <td>
                                                            <InputForm type="time" :value='day.ends_at' />
                                                        </td>
                                                        <td>
                                                            <InputForm type="time" :value='day.starts_at' />
                                                        </td>
                                                        <td>
                                                            <InputForm type="time" :value='day.ends_at' />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>-->
                <div class="flex justify-center mt-8">
                    <button class="btn btn-outline btn-error mr-4">{{ t('admin.buttons.cancel') }}</button>
                    <button class="btn btn-outline btn-success" @click="submit">{{ t('admin.buttons.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</template>