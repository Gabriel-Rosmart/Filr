<script setup>

    /** Function imports */
    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia"
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

    const props = defineProps({
        url: String,
        filters: Object
    })

    const clearInput = () => {
        search.value = ''
        opt.value = ''
        incidence.value = ''
        date.value = ''
    }

    let search = ref(props.filters.search ?? '')
    let opt = ref(props.filters.type ?? '')
    let incidence = ref(props.filters.incidence ?? '')
    let date = ref(props.filters.date ?? '')

    watch([search, opt, incidence, date], throttle(([sval, oval, ival, dval]) => {
        Inertia.get(props.url, {
            search: sval,
            type: oval,
            incidence: ival,
            date: dval
        },
        {
            preserveState: true,
            remember: true
        })
    }, 300))
</script>

<template>
    <input type="text" :placeholder="t('admin.query.search')" class="input input-bordered w-full max-w-xs mx-4" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" v-model="opt">
        <option disabled selected value="">{{ t('admin.query.employee.main') }}</option>
        <option value="">Todos</option>
        <option value="profesor">Profesor</option>
        <option value="administrativo">Administrativo</option>
        <option value="limpieza">Limpieza</option>
    </select>
    <select class="select select-bordered w-full max-w-xs ml-4" v-model="incidence">
        <option disabled selected value="">{{ t('admin.query.incidence.main') }}</option>
        <option value="">{{ t('admin.query.incidence.all') }}</option>
        <option value="early">{{ t('admin.query.incidence.early') }}</option>
        <option value="late">{{ t('admin.query.incidence.late') }}</option>
        <option value="absent">{{ t('admin.query.incidence.absent') }}</option>
    </select>
    <input type="date" class="input input-bordered w-full max-w-xs ml-4" v-model="date">
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>