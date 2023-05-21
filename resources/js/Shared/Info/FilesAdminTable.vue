<script setup>
    import { useI18n } from 'vue-i18n';

    const { t, d } = useI18n()

    const props = defineProps({
        files: Array
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

        if(mornFiles.timestamp.length >= 1) shifts.push(mornFiles.timestamp[0])
        if(mornFiles.timestamp.length >= 3) shifts.push(mornFiles.timestamp[2])
        console.log(shifts);
        return shifts
    }

    const getAfternoonShift = (aftFiles) => {
        let shifts = []

        if(aftFiles.timestamp.length >= 2) shifts.push(aftFiles.timestamp[1])
        if(aftFiles.timestamp.length >= 4) shifts.push(aftFiles.timestamp[3])

        return shifts
    }

    const getAdditionalFiles = (otherFiles) => {
        let files = []

        for (let i = 4; i < otherFiles.timestamp.length; i++) {
            files.push(otherFiles.timestamp[i])           
        }

        return files
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
                    <th>otros fichajes</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file in orderedDate" class="hover">
                    <td> {{ d(file.date, 'short') }} </td>
                    <td>
                        <span v-for="(shift, i) in getMorningShift(file)" class="flex flex-col mb-2">{{ shift }}</span>                   
                    </td>  
                    <td>
                        <span v-for="shift of getAfternoonShift(file)" class="flex flex-col mb-2">{{ shift }}</span>         
                    </td> 
                    <td>
                        <span v-for="shift of getAdditionalFiles(file)" class="flex flex-col mb-2">{{ shift }}</span>         
                    </td>                                
                </tr> 
            </tbody>
        </table>

    </div>
</template>