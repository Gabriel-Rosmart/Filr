<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import FormInputError from '@/Shared/Forms/FormInputError.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const props = defineProps({
    user: Object,
    dates: Object,
})

const n = {
    id: null,
    date_range_id: null,
    start_date: null,
    end_date: null
}

const form = useForm({
    id: null,
    user_id: props.user.id,
    dates:{
        start_date: null,
        end_date: null
    }
});

const submit = (id, date_range_id, start_date, end_date) => {
    form.id = id;
    form.date_range_id = date_range_id;
    form.dates['start_date'] = start_date;
    form.dates['end_date'] = end_date;
    console.log(form);
    form.post('/admin/dates');
};

console.log(props.user);
console.log(props.dates);
console.log(form);


</script>

<template>
    <AdminLayout>

        <Head title="Edit User" />
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], [t('breadcrumbs.manage'), '/admin/manage'], [user.name, '/admin/details?id=' + user.id], [t('admin.buttons.dates'), 'Dates']]" />
        <div class="ml-12">
            <form @submit.prevent="" v-for="date in dates">
                <FormInputError class="mt-12" :message="form.errors.dates"/>
                <div class="grid items-center grid-cols-2 w-1/2 mt-4">
                    <label for="id">Id</label>
                    <p class="m-2">{{ date.date_range_id }}</p>
                    <label for="start_date">Start Date</label>
                    <input class="bg-transparent input-bordered w-full max-w-xs m-2" type="date" v-model="date.start_date">
                    <label for="end_date">End Date</label>
                    <input class="bg-transparent input-bordered w-full max-w-xs m-2" type="date" v-model="date.end_date">
                    <button class="btn btn-outline btn-success m-auto w-1/2" @click="submit(date.id, date.date_range_id, date.start_date, date.end_date)">{{ t('admin.buttons.save') }}</button>
                </div>
            </form>
            <form @submit.prevent="">
                <!-- <FormInputError :message="form.errors.dates"/> -->
                <div class="grid items-center grid-cols-2 w-1/2 mt-12">
                    <label for="id">Id</label>
                    <input class="bg-transparent input-bordered w-full max-w-xs m-2" type="text" disabled placeholder="New">
                    <label for="start_date">Start Date</label>
                    <input class="bg-transparent input-bordered w-full max-w-xs m-2" type="date" v-model="n.start_date">
                    <label for="end_date">End Date</label>
                    <input class="bg-transparent input-bordered w-full max-w-xs m-2" type="date" v-model="n.end_date">
                    <button class="btn btn-outline btn-success m-auto w-1/2" @click="submit(n.id, n.date_range_id, n.start_date, n.end_date)">{{ t('admin.buttons.save') }}</button>
                </div>
            </form>
        </div>
</AdminLayout></template>
