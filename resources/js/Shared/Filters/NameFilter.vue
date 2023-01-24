<script setup>

    import { ref, watch } from "vue"

    let search = ref('')

    watch(search, () => {
        console.log(search.value)
    })

</script>

<template>
    <input type="text" placeholder="Search..." class="input input-bordered w-full max-w-xs mx-4" id="search" v-model="search" />
</template>