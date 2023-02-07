<script setup>
defineProps(['tittle','data', 'rol']);
</script>

<template>
    <div>
        <label>{{ tittle }}</label>
        <br/>
        <select class="select select-primary w-full max-w-xs">
            <template v-if="rol == 1">
                <option value="1" selected>Profesor</option>
                <option value="2">Administrativo</option>
                <option value="3">Limpieza</option>
            </template>
            <template v-if="rol == 2">
                <option value="1">Profesor</option>
                <option value="2" selected>Administrativo</option>
                <option value="3">Limpieza</option>
            </template>
            <template v-if="rol == 3">
                <option value="1">Profesor</option>
                <option value="2">Administrativo</option>
                <option value="3" selected>Limpieza</option>
            </template>
        </select>
    </div>
</template>