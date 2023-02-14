<script setup>

import getIncidenceMessage from '@/Utilities/incidence';
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

defineProps({
    incidences: Array
})
</script>
<template>
    <div v-if="incidences.length > 0">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>{{ t('table.date') }}</th>
                    <th>{{ t('table.subject') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidence of incidences">
                    <td>{{ incidence.date }}</td>
                    <td v-html="getIncidenceMessage(incidence.subject, incidence.minutes)"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <div class="alert alert-success shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ t('admin.details.noIncidence') }}</span>
            </div>
        </div>
    </div>
</template>