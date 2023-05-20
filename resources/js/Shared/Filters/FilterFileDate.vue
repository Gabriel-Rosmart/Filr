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
        updateCurrentKey()
    }

    let date = ref(props.filter.date ?? '')

    watch([date], throttle(([dval]) => {
        Inertia.get(props.url, {
            date: dval
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
    <vue-tailwind-datepicker as-single :i18n="locale" :formatter="formatter" v-model="date" :key="updateKey"
    input-classes="input input-bordered w-full max-w-xs ml-4" id="datepicker" :placeholder="t('dateformat')" />

</template>

<style scoped>
#datepicker {
    max-width: 20rem;
}
</style>