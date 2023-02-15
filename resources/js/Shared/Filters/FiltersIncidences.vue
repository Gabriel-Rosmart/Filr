<script setup>
    /** Function imports */
    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia"

    import { useI18n } from 'vue-i18n'

    import VueTailwindDatepicker from 'vue-tailwind-datepicker'

    const { t, locale } = useI18n()

    const props = defineProps({
        url: String,
        filters: Object
    })

    /** This forces the datepicker to update */

    let updateKey = 0

    const updateCurrentKey = () => {
        updateKey += 1
        if(updateKey > 2) updateKey = 0
    }

    /** */

    const clearInput = () => {
        search.value = ''
        opt.value = ''
        date.value = ''
        updateCurrentKey()
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

    const formatter = ref({
        date: 'YYYY-MM-DD',
        month: 'MMM'
    })
</script>

<template>
    <input type="text" :placeholder="t('admin.query.search')" class="input input-bordered w-full max-w-xs mx-4" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" v-model="opt">
        <option disabled selected value="">{{ t('admin.query.incidence.main') }}</option>
        <option value="">{{ t('admin.query.incidence.all') }}</option>
        <option value="early">{{ t('admin.query.incidence.early') }}</option>
        <option value="late">{{ t('admin.query.incidence.late') }}</option>
        <option value="absent">{{ t('admin.query.incidence.absent') }}</option>
    </select>
    <vue-tailwind-datepicker as-single :i18n="locale" :formatter="formatter" v-model="date" :key="updateKey"
    input-classes="input input-bordered w-full max-w-xs ml-4" id="datepicker" :placeholder="t('dateformat')" />
    <button class="btn btn-ghost ml-8" @click="clearInput">Reset</button>
</template>


<style scoped>
#datepicker {
    max-width: 20rem;
}
</style>