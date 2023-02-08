<script setup>

    import getIncidenceMessage from '@/Utilities/incidence';

    defineProps({
        incidences: Array
    })
</script>
<template>
    <div>
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Motivo</th>
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
</template>