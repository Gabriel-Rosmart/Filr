<script setup>

    import { ref, watch } from "vue"
    import { useI18n } from 'vue-i18n'
    import { throttle } from 'lodash'
    import { Inertia } from "@inertiajs/inertia";

    const { t } = useI18n()

    let search = ref('')

    const props = defineProps({
        url: String
    })

    const clearInput = () => {
        document.getElementById('typeSelect').selectedIndex = 0
        document.getElementById('search').value = ""
        search.value = ''
    }

    const retrieve = () => {
        console.log(document.getElementById('typeSelect').value)
    }

    watch(search, throttle((value) => {
        Inertia.get(props.url, {
            search: value
        },
        {
            preserveState: true
        })
    }, 300))

</script>

<template>
    <input type="text" :placeholder="t('admin.query.search')" class="input input-bordered w-full max-w-xs mx-4" id="search" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" id="typeSelect" @change="retrieve">
        <option disabled selected>{{ t('admin.query.employee.main') }}</option>
        <option value="teacher">Teacher</option>
        <option value="administrative">Administrative</option>
    </select>
    <button class="btn btn-primary btn-outline ml-8">Filter</button>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>