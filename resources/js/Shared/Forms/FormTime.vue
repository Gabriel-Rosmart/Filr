<script setup>

    import { ClockIcon } from '@/Shared/Icons/Icons'

    defineProps(['modelValue']);

    defineEmits(['update:modelValue']);

</script>


<template>
    <div class="flex items-center input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0">
        <ClockIcon/>
        <input
        id="timepicker"
        placeholder="--:--"
        type="text"
        class="bg-transparent border-none w-full max-w-xs focus:border-none focus:ring-0"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
    </div>
</template>

<style scoped>

/** class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0" */
</style>