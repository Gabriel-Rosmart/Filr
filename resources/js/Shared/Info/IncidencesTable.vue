<script setup>
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
                    <td>{{ incidence.date }}</td>
                    <td>{{ incidence.subject }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>