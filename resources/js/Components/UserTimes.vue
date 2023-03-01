<script setup>
import InputForm from "@/Components/InputForm.vue";
import { useI18n } from 'vue-i18n';

const { t } = useI18n()
const props = defineProps({
    weekend: Array,
    form: Object
})
console.log(props.form.schedules);
function removeSeconds(time) {
    if (time != null) {
        if (time.length == 8)
            return time.slice(0, -3);
        else
            return time;
    }
}

var monday, tuesday, wednesday, thursday, friday;

props.weekend.forEach(element => {
    console.log(element.day);
    if (element.day == 'monday') {
        if (monday == undefined) {
            monday = [element];
            props.form.schedules.monday[0] = removeSeconds(element.starts_at);
            props.form.schedules.monday[1] = removeSeconds(element.ends_at);
        } else {
            monday = [monday[0], element];
            props.form.schedules.monday[2] = removeSeconds(element.starts_at);
            props.form.schedules.monday[3] = removeSeconds(element.ends_at);
        }
    }
    if (element.day == 'tuesday') {
        if (tuesday == undefined) {
            tuesday = [element];
            props.form.schedules.tuesday[0] = removeSeconds(element.starts_at);
            props.form.schedules.tuesday[1] = removeSeconds(element.ends_at);
        } else {
            tuesday = [tuesday[0], element];
            props.form.schedules.tuesday[2] = removeSeconds(element.starts_at);
            props.form.schedules.tuesday[3] = removeSeconds(element.ends_at);
        }
    }
    if (element.day == 'wednesday') {
        if (wednesday == undefined) {
            wednesday = [element];
            props.form.schedules.wednesday[0] = removeSeconds(element.starts_at);
            props.form.schedules.wednesday[1] = removeSeconds(element.ends_at);
        } else {
            wednesday = [wednesday[0], element];
            props.form.schedules.wednesday[2] = removeSeconds(element.starts_at);
            props.form.schedules.wednesday[3] = removeSeconds(element.ends_at);
        }
    }
    if (element.day == 'thursday') {
        if (thursday == undefined) {
            thursday = [element];
            props.form.schedules.thursday[0] = removeSeconds(element.starts_at);
            props.form.schedules.thursday[1] = removeSeconds(element.ends_at);
        } else {
            thursday = [thursday[0], element];
            props.form.schedules.thursday[2] = removeSeconds(element.starts_at);
            props.form.schedules.thursday[3] = removeSeconds(element.ends_at);
        }
    }
    if (element.day == 'friday') {
        if (friday == undefined) {
            friday = [element];
            props.form.schedules.friday[0] = removeSeconds(element.starts_at);
            props.form.schedules.friday[1] = removeSeconds(element.ends_at);
        } else {
            friday = [friday[0], element];
            props.form.schedules.friday[2] = removeSeconds(element.starts_at);
            props.form.schedules.friday[3] = removeSeconds(element.ends_at);
        }
    }
});

console.log(props.form);

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
                    <th>{{ t('days.' + day[0].day) }}</th>
                    <td>
                        <InputForm v-if="day[0]" type="time" v-model="form.schedules[day[0].day][0]"/>
                        <InputForm v-else type="time" />
                    </td>
                    <td>
                        <InputForm v-if="day[0]" type="time" v-model="form.schedules[day[0].day][1]"/>
                        <InputForm v-else type="time" />
                    </td>
                    <td>
                        <InputForm v-if="day[1]" type="time" v-model="form.schedules[day[0].day][2]"/>
                        <InputForm v-else type="time" />
                    </td>
                    <td>
                        <InputForm v-if="day[1]" type="time" v-model="form.schedules[day[0].day][3]"/>
                        <InputForm v-else type="time" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>