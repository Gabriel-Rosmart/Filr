<script setup>
    import { useI18n } from 'vue-i18n';

    const { t, d } = useI18n()

    const props = defineProps({
        files: Array,
        incidences: Array
    })

    let orderedDate = []

    let prevDate = ""
    props.files.forEach(file => {
        console.log(file.date)
        if (file.date != prevDate){
            prevDate = file.date
            orderedDate.push({
                "date" : file.date,
                "timestamp":[file.timestamp]
            })
        } else{
            orderedDate.forEach(date => {
                if(date.date == prevDate){         
                    date.timestamp.push(file.timestamp)
                }
            });
        }
    });

    const getMorningShift = (mornFiles) => {
        let shifts = []
            for (let j = 0; j < mornFiles.timestamp.length; j++) 
                if( j % 2 == 0)
                    shifts.push(mornFiles.timestamp[j])
        console.log(shifts);
        return shifts
    }

    const getAfternoonShift = (aftFiles) => {
        let shifts = []
        for (let j = 0; j < aftFiles.timestamp.length; j++) 
            if( j % 2 == 1)
                shifts.push(aftFiles.timestamp[j])
        console.log(shifts);
        return shifts
    }

    console.log(orderedDate);
   
</script>

<template>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>{{ t('table.date') }}</th>
                    <th>{{ t('table.in') }}</th>
                    <th>{{ t('table.out') }}</th>
                    <th>{{ t('admin.details.incidences') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file in orderedDate" class="hover">
                    <td> {{ d(file.date, 'short') }} </td>
                    <td>
                        <span v-for="shift in getMorningShift(file)" class="flex flex-col mb-2">{{ shift }}</span>                   
                    </td>  
                    <td>
                        <span v-for="shift of getAfternoonShift(file)" class="flex flex-col mb-2">{{ shift }}</span>         
                    </td> 
                    <td>
                        <div v-for="incidence in incidences" class="flex flex-col mb-2">
                            <span v-if="incidence.date == file.date" v-html="t(`table.${incidence.subject}`, { minutes: incidence.minutes })"></span>
                        </div>
                    </td>                                
                </tr> 
            </tbody>
        </table>

    </div>
</template>