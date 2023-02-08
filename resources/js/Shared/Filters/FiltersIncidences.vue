<script setup>
    /** Function imports */
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
        date.value = ''
    }

    let search = ref(props.filters.search ?? '')
    let opt = ref(props.filters.subject ?? '')
    let date = ref(props.filters.date ?? '')

    watch([search, opt, date], throttle(([sval, oval, dval]) => {
        Inertia.get(props.url, {
            search: sval,
            subject: oval,
            date: dval
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
        <option disabled selected value="">Tipo de incidencia</option>
        <option value="">Todos</option>
        <option value="early">Salen antes</option>
        <option value="late">Llegan tarde</option>
        <option value="absent">No han venido</option>
    </select>
    <input type="date" class="input input-bordered w-full max-w-xs ml-4" v-model="date">
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>