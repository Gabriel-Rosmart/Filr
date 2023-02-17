<script setup>

    /** Function imports */
    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia";
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()


    const props = defineProps({
        url: String,
        filters: Object,
        roles: Array,
    })

    let search = ref(props.filters.search ?? '')
    let option = ref(props.filters.type ?? '')
    let active = ref(props.filters.active ?? '')

    const clearInput = () => {
        search.value = ''
        option.value = ''
        active.value = ''
    }

    watch([search, option, active], throttle(([sval, oval, aval]) => {
        Inertia.get(props.url, {
            search: sval,
            type: oval,
            active: aval
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
        <option value="">{{ t('employees.all') }}</option>
        <option v-for="role in roles" :value="role.role_name">{{ t(`employees.${role.role_name}`) }}</option>
    </select>
    <select class="select select-bordered w-full max-w-xs ml-4" v-model="active">
        <option disabled selected value="">{{ t('admin.query.userstate.main') }}</option>
        <option value="">{{ t('admin.query.userstate.all') }}</option>
        <option value="true">{{ t('admin.query.userstate.active') }}</option>
        <option value="false">{{ t('admin.query.userstate.inactive') }}</option>
    </select>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>