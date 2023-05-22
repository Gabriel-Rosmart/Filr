<script setup>
    import { Link } from "@inertiajs/inertia-vue3";
    import getIncidenceMessage from '@/Utilities/incidence';
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

    defineProps({
        users: Array,
    })

    const getMorningShift = (files) => {
        let shifts = []

        if(files.length >= 1) shifts.push(files[0].timestamp)
        if(files.length >= 3) shifts.push(files[2].timestamp)

        return shifts
    }

    const getAfternoonShift = (files) => {
        let shifts = []

        if(files.length >= 2) shifts.push(files[1].timestamp)
        if(files.length >= 4) shifts.push(files[3].timestamp)

        return shifts
    }

    const getAdditionalFiles = (otherFiles) => {
        let files = []

        for (let i = 4; i < otherFiles.length; i++) {
            files.push(otherFiles[i].timestamp)           
        }

        return files
    }

</script>

<template>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>{{ t('table.name') }}</th>
                    <th>{{ t('table.in') }}</th>
                    <th>{{ t('table.out') }}</th>
                    <th>{{ t('table.other') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user of users" class="hover">
                    <td><Link class="dark:hover:text-cyan-400 hover:underline" :href="'/admin/details?id=' + user.id">{{ user.name }}</Link></td>
                    <td>
                        <div class="flex flex-col">
                            <span v-for="file of getMorningShift(user.files)" class="mb-2">
                                {{ file }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span v-for="shift of getAfternoonShift(user.files)" class="mb-2">
                                {{ shift }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span v-for="shift of getAdditionalFiles(user.files)" class="mb-2">
                                {{ shift }}
                            </span>         
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-start flex-col">
                            <span v-for="incidence of user.incidences" 
                                v-html="t(`table.${incidence.subject}`, { minutes: incidence.minutes})">
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>