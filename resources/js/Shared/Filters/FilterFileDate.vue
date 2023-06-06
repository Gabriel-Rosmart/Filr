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
        date.value = null
        month.value = null
        year.value = null
        updateCurrentKey()
    }

    let date = ref(props.filter.date ?? '')
    let month = ref(props.filter.month ?? '')
    let year = ref(props.filter.year ?? '')

    watch([date, month, year], throttle(([dval, mval, yval]) => {
        Inertia.get(props.url, {
            date: dval,
            month: mval,
            year: yval
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
    <select name="year" class="select select-bordered w-50 max-w-xs" v-model="year">
        <option selected value="">{{ t('file.year.choose') }}</option>
        <option selected value="2023">2023</option>
        <option selected value="2024">2024</option>
        <option selected value="2025">2025</option>
        <option selected value="2026">2026</option>
        <option selected value="2027">2027</option>
    </select>
    <select name="dob-month" class="select select-bordered w-50 max-w-xs" v-model="month">
        <option selected value="">{{ t('file.month.choose') }}</option>
        <option value="01">{{ t('file.month.Jan') }}</option>
        <option value="02">{{ t('file.month.Feb') }}</option>
        <option value="03">{{ t('file.month.Mar') }}</option>
        <option value="04">{{ t('file.month.Apr') }}</option>
        <option value="05">{{ t('file.month.May') }}</option>
        <option value="06">{{ t('file.month.Jun') }}</option>
        <option value="07">{{ t('file.month.Jul') }}</option>
        <option value="08">{{ t('file.month.Aug') }}</option>
        <option value="09">{{ t('file.month.Sep') }}</option>
        <option value="10">{{ t('file.month.Oct') }}</option>
        <option value="11">{{ t('file.month.Nov') }}</option>
        <option value="12">{{ t('file.month.Dec') }}</option>
    </select>
    <vue-tailwind-datepicker as-single :start-from="new Date('2023', (Number(month)-1), 1)" :i18n="locale" :formatter="formatter" v-model="date" :key="updateKey"
    input-classes="input input-bordered w-full max-w-xs" id="datepicker" :placeholder="t('dateformat')" />
    <button class = "btn btn-outline" @click="clearInput()">Reset</button>
</template>

<style scoped>
#datepicker {
    max-width: 20rem;
}
</style>