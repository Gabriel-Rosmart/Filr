<script setup>
/** Component imports */
import InputForm from "@/Components/InputForm.vue";
import FormInputError from "@/Shared/Forms/FormInputError.vue";
import { useI18n } from 'vue-i18n';

const { t } = useI18n()
const props = defineProps({
    weekend: Object,
    form: Object,
    dates: Object,
    range: Object
})
function removeSeconds(time) {
    if (time != null) {
        if (time.length == 8)
            return time.slice(0, -3);
        else
            return time;
    } else {
        return '00:00';
    }
}

let rangeSelect = props.range

console.log(props.weekend);

const week = [];
const ids = [];

for (const [key, element] of Object.entries(props.weekend)) {
    console.log(element);
    if (week[element.date_range_id]) {
        week[element.date_range_id].push(element);
    } else {
        week[element.date_range_id] = [];
        week[element.date_range_id].push(element);
    }
}

props.dates.forEach(element => {
    console.log(element);
    ids.push(element.id);
});

console.table(props.dates);
console.log(ids);

function linkwithform(event) {
    let id = event.target.value
    props.form.schedules = {
        monday: [null, null, null, null],
        tuesday: [null, null, null, null],
        wednesday: [null, null, null, null],
        thursday: [null, null, null, null],
        friday: [null, null, null, null]
    }
    if (week[id]) {
        week[id].forEach(element => {
            if (element.day == 'monday') {
                if (props.form.schedules.monday[0] == null) {
                    props.form.schedules.monday[0] = removeSeconds(element.starts_at);
                    props.form.schedules.monday[1] = removeSeconds(element.ends_at);
                } else {
                    props.form.schedules.monday[2] = removeSeconds(element.starts_at);
                    props.form.schedules.monday[3] = removeSeconds(element.ends_at);
                }
            }
            if (element.day == 'tuesday') {
                if (props.form.schedules.tuesday[0] == null) {
                    props.form.schedules.tuesday[0] = removeSeconds(element.starts_at);
                    props.form.schedules.tuesday[1] = removeSeconds(element.ends_at);
                } else {
                    props.form.schedules.tuesday[2] = removeSeconds(element.starts_at);
                    props.form.schedules.tuesday[3] = removeSeconds(element.ends_at);
                }
            }
            if (element.day == 'wednesday') {
                if (props.form.schedules.wednesday[0] == null) {
                    props.form.schedules.wednesday[0] = removeSeconds(element.starts_at);
                    props.form.schedules.wednesday[1] = removeSeconds(element.ends_at);
                } else {
                    props.form.schedules.wednesday[2] = removeSeconds(element.starts_at);
                    props.form.schedules.wednesday[3] = removeSeconds(element.ends_at);
                }
            }
            if (element.day == 'thursday') {
                if (props.form.schedules.thursday[0] == null) {
                    props.form.schedules.thursday[0] = removeSeconds(element.starts_at);
                    props.form.schedules.thursday[1] = removeSeconds(element.ends_at);
                } else {
                    props.form.schedules.thursday[2] = removeSeconds(element.starts_at);
                    props.form.schedules.thursday[3] = removeSeconds(element.ends_at);
                }
            }
            if (element.day == 'friday') {
                if (props.form.schedules.friday[0] == null) {
                    props.form.schedules.friday[0] = removeSeconds(element.starts_at);
                    props.form.schedules.friday[1] = removeSeconds(element.ends_at);
                    props.form.schedules.friday[2] = null;
                    props.form.schedules.friday[3] = null;
                } else {
                    props.form.schedules.friday[2] = removeSeconds(element.starts_at);
                    props.form.schedules.friday[3] = removeSeconds(element.ends_at);
                }
            }
        });
        for (const [key, value] of Object.entries(props.form.schedules)) {
            if (value[0] > '14:00' && value[2] == null) {
                props.form.schedules[key][2] = value[0];
                props.form.schedules[key][3] = value[1];
                props.form.schedules[key][0] = null;
                props.form.schedules[key][1] = null;
            }
        }
    }

}
for (const key in props.form.errors) {
    console.log(props.form.errors[key])
}
console.table(props.form.errors['schedules.monday']);
console.log(props.dates);

function getDates(id) {
    for (let i = 0; i < props.dates.length; i++) {
        if(props.dates[i].id == id){
            return props.dates[i].start_date + ' / ' + props.dates[i].end_date
        }
    }
}

</script>

<template>
    <div class="flex flex-col">
        <span v-for="error in form.errors" class="block w-full text-center">
            <FormInputError :message="error" />
        </span>           
        <select class='bg-transparent input-bordered w-full max-w-xs mb-4' @change="linkwithform($event)" v-model="form.schedules_id" >
            <option selected value="" >Rangos de fechas del usuario</option>
            <option v-for="id, index in ids" :key="index" :value="id" >
                {{ getDates(id)}} 
            </option>
        </select>  
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
                    <tr v-for="(day, index) in props.form.schedules" :key='index'> 
                        <th>{{ t('days.' + index) }}</th>
                        <td>
                            <InputForm type="time" v-model="form.schedules[index][0]" />
                        </td>
                        <td>
                            <InputForm type="time" v-model="form.schedules[index][1]" />
                        </td>
                        <td>
                            <InputForm type="time" v-model="form.schedules[index][2]" />
                        </td>
                        <td>
                            <InputForm type="time" v-model="form.schedules[index][3]" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>      
    </div>
</template>