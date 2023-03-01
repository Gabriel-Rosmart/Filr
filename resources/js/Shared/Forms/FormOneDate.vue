<script setup>
    import FormTime from '@/Shared/Forms/FormTime.vue';
    import FormLabel from '@/Shared/Forms/FormLabel.vue';
</script>
<template>
    <div class="flex flex-row gap-5">
        <input type="date" class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0"/>
        <FormTime />
        <FormTime />
    </div>
</template>