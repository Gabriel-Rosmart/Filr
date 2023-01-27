<script setup>

    import { ref, watch } from "vue"
    import { throttle } from 'lodash'
    import { Inertia } from '@inertiajs/inertia'

    let search = ref('')

    const props = defineProps({
        url: String
    })

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
    <input type="text" placeholder="Search..." class="input input-bordered w-full max-w-xs mx-4" id="search" v-model="search" />
</template>