<script setup>

    defineProps(['modelValue']);

    defineEmits(['update:modelValue']);

</script>


<template>
    <input
        type="time"
        class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
