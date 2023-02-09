<script setup>

    /** Component imports */
    import { Link } from '@inertiajs/inertia-vue3'

    /** Function imports */
    import getIncidenceMessage from '@/Utilities/incidence';
    import format from '@/Utilities/datefm'

    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

    defineProps({
        incidences: Array
    })
</script>

<template>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>{{ t('table.employee') }}</th>
                    <th>{{ t('table.date') }}</th>
                    <th>{{ t('table.subject') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidence of incidences">
                    <td><Link class="dark:hover:text-cyan-400 hover:underline" :href="'/admin/details?id=' + incidence.user.id">{{ incidence.user.name }}</Link></td>
                    <td>{{ format(incidence.date) }}</td>
                    <td v-html="getIncidenceMessage(incidence.subject, incidence.minutes)"></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>