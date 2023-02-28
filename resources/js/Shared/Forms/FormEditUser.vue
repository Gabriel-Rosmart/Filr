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

var form = useForm({
    id: props.user.id,
    name: props.user.name,
    dni: props.user.dni,
    telephone: props.user.phone,
    email: props.user.email,
    schedules: {
        monday: [null, null, null, null],
        tuesday: [null, null, null, null],
        wednesday: [null, null, null, null],
        thursday: [null, null, null, null],
        friday: [null, null, null, null]
    }
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
                <UserTimes :weekend="timetable" :form="form" />
                <div class="flex justify-center mt-8">
                    <button class="btn btn-outline btn-error mr-4">{{ t('admin.buttons.cancel') }}</button>
                    <button class="btn btn-outline btn-success" @click="submit">{{ t('admin.buttons.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</template>