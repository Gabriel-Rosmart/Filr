<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import FormInputError from '@/Shared/Forms/FormInputError.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { Link } from '@inertiajs/inertia-vue3'

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

if(form.errors.dates){
    let msg = form.errors.dates.split('/')[0]
    let errorID = form.errors.dates.split('/')[1]
}

</script>

<template>
    <AdminLayout>

        <Head title="Edit User" />
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], [t('breadcrumbs.manage'), '/admin/manage'], [user.name, '/admin/details?id=' + user.id], [t('admin.buttons.dates'), 'Dates']]" />
        <div class="container mt-10 mx-10">
            <FormInputError :message="form.errors.dates"/>
            <div class="flex justify-center mb-10">
            <table class="table w-full">
                <thead>
                    <th></th>
                    <th>{{ t('permits.startDate') }}</th>
                    <th>{{ t('permits.endDate') }}</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>               
                    <tr>    
                        <td>
                            <form id="formNew" @submit.prevent=""></form>
                        </td>
                        <td><input form="formNew" class="bg-transparent input-bordered " type="date" v-model="n.start_date"></td>
                        <td><input form="formNew" class="bg-transparent input-bordered " type="date" v-model="n.end_date"></td>
                        <td><button form="formNew" class="btn btn-outline btn-info " @click="submit(n.id, n.date_range_id, n.start_date, n.end_date)">{{t('admin.buttons.add')}}</button></td>
                        <td></td>
                    </tr>
                    
                    <tr v-for="date in dates">
                        <td><form :id="'form'+date.id" @submit.prevent=""></form></td>
                        <td><input :form="'form'+date.id" class="bg-transparent input-bordered" type="date" v-model="date.start_date"></td>
                        <td><input :form="'form'+date.id" class="bg-transparent input-bordered" type="date" v-model="date.end_date"></td>
                        <td><button :form="'form'+date.id" class="btn btn-outline btn-success " @click="submit(date.id, date.date_range_id, date.start_date, date.end_date)">{{ t('admin.buttons.save') }}</button></td>
                        <td><Link class="btn btn-outline" as="button" :href="'/admin/edit?id=' + user.id + '&range=' + date.id">{{t('admin.buttons.editSchedule')}}</Link></td>
                    </tr>                   
                </tbody>
            </table>
        </div>
    </div>
            
            
</AdminLayout></template>
