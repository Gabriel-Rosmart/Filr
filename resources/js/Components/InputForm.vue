<script setup>
 import { onMounted, ref } from 'vue';
defineProps(['title','type','value','modelValue']);

const input = ref(null);

defineEmits(['update:modelValue']);
</script>

<template>
    <div>
        <label>{{ title }}</label>
        <input v-if="type != 'time'" :type="type" class="input input-bordered input-primary w-full mt-2" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)" ref="input" />
        <input v-else :type="type" class="input input-bordered input-primary w-full mt-2" :value="value" />
    </div>
</template>