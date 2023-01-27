<script setup>

    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia";


    const props = defineProps({
        url: String,
        filters: Object
    })

    let search = ref(props.filters.search ?? '')
    let option = ref(props.filters.type ?? '')
    let active = ref(props.filters.active ?? '')

    const clearInput = () => {
        search.value = ''
        option.value = ''
        active.value = ''
    }

    watch([search, option, active], throttle(([sval, oval, aval]) => {
        Inertia.get(props.url, {
            search: sval,
            type: oval,
            active: aval
        },
        {
            preserveState: true,
            remember: true
        })
    }, 300))

</script>

<template>
    <input type="text" placeholder="Buscar..." class="input input-bordered w-full max-w-xs mx-4" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" v-model="option">
        <option disabled selected value="">Tipo de empleado</option>
        <option value="">Todos</option>
        <option value="profesor">Profesor</option>
        <option value="administrativo">Administrativo</option>
        <option value="limpieza">Limpieza</option>
    </select>
    <select class="select select-bordered w-full max-w-xs ml-4" v-model="active">
        <option disabled selected value="">Estado</option>
        <option value="">Cualquiera</option>
        <option value="true">Activo</option>
        <option value="false">De baja</option>
    </select>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>