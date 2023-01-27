<script setup>

    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia"

    const props = defineProps({
        url: String,
        filters: Object
    })

    const clearInput = () => {
        search.value = ''
        opt.value = ''
    }

    let search = ref(props.filters.search ?? '')
    let opt = ref(props.filters.type ?? '')

    watch([search, opt], throttle(([sval, oval]) => {
        Inertia.get(props.url, {
            search: sval,
            type: oval
        },
        {
            preserveState: true,
            remember: true
        })
    }, 300))
</script>

<template>
    <input type="text" placeholder="Buscar..." class="input input-bordered w-full max-w-xs mx-4" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" v-model="opt">
        <option disabled selected value="">Tipo de empleado</option>
        <option value="">Todos</option>
        <option value="profesor">Profesor</option>
        <option value="administrativo">Administrativo</option>
        <option value="limpieza">Limpieza</option>
    </select>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>