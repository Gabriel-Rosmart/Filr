<script setup>

    import getIncidenceMessage from '@/Utilities/incidence';
    import format from '@/Utilities/datefm'

    defineProps({
        incidences: Array
    })
</script>

<template>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Fecha</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidence of incidences">
                    <td>{{ incidence.user.name }}</td>
                    <td>{{ format(incidence.date) }}</td>
                    <td v-html="getIncidenceMessage(incidence.subject, incidence.minutes)"></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>