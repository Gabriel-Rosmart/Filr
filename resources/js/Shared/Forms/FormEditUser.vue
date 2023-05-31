<script setup>
/** Component imports */
import UserData from "@/Components/UserData.vue";
import UserTimes from "@/Components/UserTimes.vue";
import { useForm } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3';
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const props = defineProps({
    user: Object,
    timetable: Object,
    isAdmin: Number,
    dates: Object
})

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
    },
    schedules_id: null,
});

function validate(object) {
    var regex = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
    for (var i = 0; i < 4; i++) {
        if (object['monday'][i] != null) {
            if (!regex.test(object['monday'][i])) {
                object['monday'][i] = null;
            }
        }
        if (object['tuesday'][i] != null) {
            if (!regex.test(object['tuesday'][i])) {
                object['tuesday'][i] = null;
            }
        }
        if (object['wednesday'][i] != null) {
            if (!regex.test(object['wednesday'][i])) {
                object['wednesday'][i] = null;
            }
        }
        if (object['thursday'][i] != null) {
            if (!regex.test(object['thursday'][i])) {
                object['thursday'][i] = null;
            }
        }
        if (object['friday'][i] != null) {
            if (!regex.test(object['friday'][i])) {
                object['friday'][i] = null;
            }
        }
    }
}


const submit = () => {
    validate(form.schedules);
    console.log(form);
    form.post('/admin/edit');
};


</script>


<template>
    <div class="flex items-center w-full mt-8">
        <form @submit.prevent="" class="w-full pr-10">
            <div class="grid grid-cols-2 w-auto">
                <UserData :user="user" :form="form" :isAdmin="isAdmin" />
                <UserTimes :weekend="timetable" :form="form" :dates="dates"/>
                <div class="flex justify-center mt-8">
                    <Link as="button" :href="'/admin/details?id='+props.user.id" class="btn btn-outline btn-error mr-4">
                    {{ t('admin.buttons.cancel') }}
                    </Link>
                    <button class="btn btn-outline btn-success" @click="submit">{{ t('admin.buttons.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</template>