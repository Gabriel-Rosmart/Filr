<script setup>
import InputForm from "@/Components/InputForm.vue";
import { useI18n } from 'vue-i18n';

const { t } = useI18n()
const props = defineProps({
    weekend: Array,
})

var monday, tuesday, wednesday, thursday, friday;

props.weekend.forEach(element => {
    console.log(element.day);
    if (element.day == 'monday') {
        if (monday == undefined) {
            monday = [element];
        } else {
            monday = [monday[0], element];
        }
    }
    if (element.day == 'tuesday') {
        if (tuesday == undefined) {
            tuesday = [element];
        } else {
            tuesday = [tuesday[0], element];
        }
    }
    if (element.day == 'wednesday') {
        if (wednesday == undefined) {
            wednesday = [element];
        } else {
            wednesday = [wednesday[0], element];
        }
    }
    if (element.day == 'thursday') {
        if (thursday == undefined) {
            thursday = [element];
        } else {
            thursday = [thursday[0], element];
        }
    }
    if (element.day == 'friday') {
        if (friday == undefined) {
            friday = [element];
        } else {
            friday = [friday[0], element];
        }
    }
});

var week = [monday, tuesday, wednesday, thursday, friday];
console.log(week);
</script>

<template>
    <div class="flex justify-center">
        <table class="table w-max">
            <thead>
                <tr class="">
                    <th></th>
                    <th>{{ t('forms.inmorning') }}</th>
                    <th>{{ t('forms.outmorning') }}</th>
                    <th>{{ t('forms.innoon') }}</th>
                    <th>{{ t('forms.outnoon') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="day in week">
                    <th>{{ day[0].day }}</th>
                    <td>
                        <InputForm v-if="day[0]" type="time" :value='day[0].starts_at' />
                        <InputForm v-else type="time" />
                    </td>
                    <td>
                        <InputForm v-if="day[0]" type="time" :value='day[0].ends_at' />
                        <InputForm v-else type="time" />
                    </td>
                    <td>
                        <InputForm v-if="day[1]" type="time" :value='day[1].starts_at' />
                        <InputForm v-else type="time" />
                    </td>
                    <td>
                        <InputForm v-if="day[1]" type="time" :value='day[1].ends_at' />
                        <InputForm v-else type="time" />
                    </td>
                </tr>
        </tbody>
    </table>
</div></template>