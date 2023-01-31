<script setup>
defineProps(['tittle','typ','value']);
</script>

<template>
    <div>
        <label>{{ tittle }}</label>
        <br />
        <input :type="typ" :value="value" class="input input-bordered input-primary w-full" />
    </div>
</template>