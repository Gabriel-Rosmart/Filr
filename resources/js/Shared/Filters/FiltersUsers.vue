<script setup>

    import { ref, watch, onMounted } from "vue"
    import { useI18n } from 'vue-i18n'
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia";

    const { t } = useI18n()


    const props = defineProps({
        url: String,
        filters: Object
    })

    let search = ref(props.filters.search ?? '')
    let option = ref(props.filters.type ?? '')

    const clearInput = () => {
        search.value = ''
        option.value = ''
        Inertia.get(props.url)
    }

    watch(option, throttle((value) => {
        Inertia.get(props.url, {
            search: search.value,
            type: value
        },
        {
            preserveState: true,
            remember: true
        })
    }, 300))

    watch(search, throttle((value) => {
        Inertia.get(props.url, {
            search: value,
            type: option.value
        },
        {
            preserveState: true,
            remember: true
        })
    }, 300))

</script>

<template>
    <input type="text" :placeholder="t('admin.query.search')" class="input input-bordered w-full max-w-xs mx-4" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" v-model="option">
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