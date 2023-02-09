<script setup>

    /** Function imports */
    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from '@inertiajs/inertia'

    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

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
    <input type="text" :placeholder="t('admin.query.search')" class="input input-bordered w-full max-w-xs ml-4" v-model="search" />
    <select class="select select-bordered w-full max-w-xs ml-4" v-model="option">
        <option disabled selected value="">{{ t('admin.permitstate.main') }}</option>
        <option value="">{{ t('admin.permitstate.all') }}</option>
        <option value="pending">{{ t('admin.permitstate.pending') }}</option>
        <option value="accepted">{{ t('admin.permitstate.accepted') }}</option>
        <option value="denied">{{ t('admin.permitstate.denied') }}</option>
    </select>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>