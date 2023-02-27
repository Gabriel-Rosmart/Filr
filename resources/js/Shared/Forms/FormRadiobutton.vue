<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        type="radio"
        :value="value"
        v-model="proxyChecked"
        class="radio radio-primary dark:bg-gray-800 focus:ring-0 dark:border-transparent focus:border-transparent checked:bg-gray-800 checked:ring-0"
    />
</template>