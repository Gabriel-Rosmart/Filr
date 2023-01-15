<script setup>

    import { ref, watch } from "vue"

    let search = ref('')

    const clearInput = () => {
        document.getElementById('typeSelect').selectedIndex = 0
        document.getElementById('search').value = ""
        search.value = ''
    }

    const retrieve = () => {
        console.log(document.getElementById('typeSelect').value)
    }

    watch(search, () => {
        console.log(search.value)
    })

</script>

<template>
    <input type="text" placeholder="Search..." class="input input-bordered w-full max-w-xs mx-4" id="search" v-model="search" />
    <select class="select select-bordered w-full max-w-xs" id="typeSelect" @change="retrieve">
        <option disabled selected>Employee Type</option>
        <option value="teacher">Teacher</option>
        <option value="administrative">Administrative</option>
    </select>
    <button class="btn btn-primary ml-8">Filter</button>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>