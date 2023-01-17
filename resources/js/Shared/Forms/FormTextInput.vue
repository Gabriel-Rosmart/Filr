<script setup>
    import { onMounted, ref } from 'vue';

    defineProps(['modelValue']);

    defineEmits(['update:modelValue']);

    const input = ref(null);

    onMounted(() => {
        if (input.value.hasAttribute('autofocus')) {
            input.value.focus();
        }
    });

    defineExpose({ focus: () => input.value.focus() });
</script>


<template>
    <input
        class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
