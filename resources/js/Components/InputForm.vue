<script setup>
defineProps(['tittle','typ']);
</script>

<template>
    <div>
        <label>{{ tittle }}</label>
        <br />
        <input :type="typ" class="input input-bordered input-primary w-full max-w-xs" />
    </div>
</template>