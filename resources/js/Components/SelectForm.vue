<script setup>
defineProps(['title','data', 'rol', 'day', 'shift']);
</script>

<template>
    <div>
        <label>{{ title }}</label>
        <br/>
        <select v-if="rol" class="select select-primary w-full max-w-xs mt-2">
                <option v-if="rol==1" value="1" selected>Profesor</option>
                <option v-else value="1">Profesor</option>
                <option v-if="rol==2" value="2" selected>Administrativo</option>
                <option v-else value="2">Administrativo</option>
                <option v-if="rol==3" value="3" selected>Limpieza</option>
                <option v-else value="3">Limpieza</option>
        </select>
        <select v-else-if="day" class="select select-primary w-full max-w-xs">
            <option selected>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
            <option>Friday</option>
            <option>Saturday</option>
            <option>Sunday</option>
        </select>
        <select v-else-if="shift" class="select select-primary w-full max-w-xs">
            <option selected>Morning</option>
            <option>Afternoon</option>
        </select>
    </div>
</template>