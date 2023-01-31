<script setup>
defineProps(['tittle','data']);
</script>

<template>
    <div>
        <label>{{ tittle }}</label>
        <br/>
        <select class="select select-primary w-full max-w-xs">
            <option v-for="a of data">{{ a }}</option>
        </select>
    </div>
</template>