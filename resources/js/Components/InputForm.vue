<script setup>
import { onMounted, ref } from 'vue';
import { ClockIcon } from '@/Shared/Icons/Icons'
defineProps(['title', 'type', 'value', 'modelValue']);

const input = ref(null);

defineEmits(['update:modelValue']);
</script>

<template>
    <div>
        <label>{{ title }}</label>
        <input v-if="type != 'time'" :type="type" class="input input-bordered input-primary w-full mt-2" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)" ref="input" />
        <div v-else-if="type == 'time'" class="flex items-center input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0">
            <ClockIcon />
            <input class="bg-transparent border-none w-full max-w-xs focus:border-none focus:ring-0" type=text :value="modelValue" placeholder="--:--" @input="$emit('update:modelValue', $event.target.value)" ref="input"/>
        </div>
        <input v-else :type="type" class="input input-bordered input-primary w-full mt-2" :value="value" />
    </div>
</template>