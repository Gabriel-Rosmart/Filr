<script setup>

    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from '@inertiajs/inertia'

    let search = ref(props.filters.search ?? '')
    let option = ref(props.filters.status ?? '')

    const props = defineProps({
        url: String,
        filters: Object
    })

    const clearInput = () => {
        search.value = ''
        option.value = ''
    }

    watch([search, option], throttle(([sval, oval]) => {
        Inertia.get(props.url, {
            search: sval,
            status: oval
        },
        {
            preserveState: true,
            rembember: true
        })
    }, 300))

</script>

<template>
    <input type="text" placeholder="Buscar..." class="input input-bordered w-full max-w-xs mx-4" v-model="search" />
    <select class="select select-bordered w-full max-w-xs ml-4" v-model="option">
        <option disabled selected value="">Estado</option>
        <option value="">Todos</option>
        <option value="pending">Pendientes</option>
        <option value="accepted">Aceptados</option>
        <option value="denied">Denegados</option>
    </select>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>