<script setup>
 import { onMounted, ref } from 'vue';
defineProps(['title','typ','value','modelValue']);

const input = ref(null);

defineEmits(['update:modelValue']);
</script>

<template>
    <div>
        <label>{{ title }}</label>
        <input
        class="input input-bordered input-primary w-full mt-2"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
    </div>
</template>