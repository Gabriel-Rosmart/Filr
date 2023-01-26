<script setup>

    import { ref, watch } from "vue"
    import { useI18n } from 'vue-i18n'
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia";

    const { t } = useI18n()


    const props = defineProps({
        url: String,
        filters: Object
    })

    let search = ref(props.filters.search ?? '')

    const clearInput = () => {
        document.getElementById('typeSelect').selectedIndex = 0
        document.getElementById('search').value = ""
        search.value = ''
        Inertia.get(props.url)
    }

    const retrieve = () => {
        console.log(document.getElementById('typeSelect').value)
        Inertia.get(props.url, {
            search: search.value,
            type: document.getElementById('typeSelect').value
        },
        {
            preserveState: true,
            remember: true
        })
    }

    watch(search, throttle((value) => {
        Inertia.get(props.url, {
            search: value,
            type: document.getElementById('typeSelect').value
        },
        {
            preserveState: true,
            remember: true
        })
    }, 300))

</script>

<template>
    <input type="text" :placeholder="t('admin.query.search')" class="input input-bordered w-full max-w-xs mx-4" id="search" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" id="typeSelect" @change="retrieve">
        <option disabled selected value="">{{ t('admin.query.employee.main') }}</option>
        <option value="">Todos</option>
        <option value="profesor">Profesor</option>
        <option value="administrativo">Administrativo</option>
        <option value="limpieza">Limpieza</option>
    </select>
    <select class="select select-bordered w-full max-w-xs ml-4">
        <option disabled selected value="">Estado</option>
        <option value="">Cualquiera</option>
        <option value="">Activo</option>
        <option value="">De baja</option>
    </select>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>