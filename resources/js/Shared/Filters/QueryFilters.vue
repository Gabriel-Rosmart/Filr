<script setup>
    const clearInput = () => {
        document.getElementById('typeSelect').selectedIndex = 0
        document.getElementById('search').value = ""
    }
</script>

<template>
    <input type="text" placeholder="Search..." class="input input-bordered w-full max-w-xs mx-4" id="search" />
    <select class="select select-bordered w-full max-w-xs" id="typeSelect">
        <option disabled selected>Employee Type</option>
        <option>Teacher</option>
        <option>Administrative</option>
    </select>
    <button class="btn btn-primary ml-8">Filter</button>
    <button class="btn btn-ghost ml-4" @click="clearInput">Reset</button>
</template>