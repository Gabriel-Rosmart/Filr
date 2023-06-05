<script setup>
    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia"

    import { useI18n } from 'vue-i18n'
    import VueTailwindDatepicker from 'vue-tailwind-datepicker'
    const { t, locale } = useI18n()

    const props = defineProps({
        url: String,
        filter: Object
    })

    let updateKey = 0

    const updateCurrentKey = () => {
        updateKey += 1
        if (updateKey > 2) updateKey = 0
    }

    const clearInput = () => {
        search.value = ''
        opt.value = ''
        date.value = ''
        month.value=''
        updateCurrentKey()
    }

    let date = ref(props.filter.date ?? '')
    let month = ref(props.filter.month ?? '')

    watch([date, month], throttle(([dval, mval]) => {
        Inertia.get(props.url, {
            date: dval,
            month: mval,
        },
            {
                preserveState: false,
                remember: true
            })
    }, 300))

    const formatter = ref({
        date: 'YYYY-MM-DD',
        month: 'MMM'
    })

</script>

<template>
    <select name="dob-month" class="select select-bordered w-50 max-w-xs" v-model="month">
        <option selected value="">Elegir mes</option>
        <option value="01">Jan</option>
        <option value="02">Feb</option>
        <option value="03">Mar</option>
        <option value="04">Apr</option>
        <option value="05">May</option>
        <option value="06">Jun</option>
        <option value="07">Jul</option>
        <option value="08">Aug</option>
        <option value="09">Sep</option>
        <option value="10">Oct</option>
        <option value="11">Nov</option>
        <option value="12">Dec</option>
    </select>
    <vue-tailwind-datepicker as-single :start-from="new Date('2023', (Number(month)-1), 1)" :i18n="locale" :formatter="formatter" v-model="date" :key="updateKey"
    input-classes="input input-bordered w-full max-w-xs ml-4" id="datepicker" :placeholder="t('dateformat')" />
</template>

<style scoped>
#datepicker {
    max-width: 20rem;
}
</style>