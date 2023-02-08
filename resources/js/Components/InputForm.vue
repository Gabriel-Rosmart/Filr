<script setup>
defineProps(['title','typ','value']);
</script>

<template>
    <div>
        <label>{{ title }}</label>
        <input :type="typ" :value="value" class="input input-bordered input-primary w-full mt-2" />
    </div>
</template>