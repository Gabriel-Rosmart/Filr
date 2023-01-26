<template>
    <input type="text" placeholder="Search" class="input input-bordered w-full max-w-xs mx-4" id="search" />
    <select class="select select-bordered w-full max-w-xs" id="typeSelect">
        <option disabled selected value="">Tipo de empleado</option>
        <option value="">Todos</option>
        <option value="profesor">Profesor</option>
        <option value="administrativo">Administrativo</option>
        <option value="limpieza">Limpieza</option>
    </select>
    <button class="btn btn-ghost ml-4">Reset</button>
</template>