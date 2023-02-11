<script setup>
    defineProps({
        index: Number
    })
</script>

<template>
    <ul class="steps">
        <li class="step" :class="{'step-primary': index == 0}"/>
        <li class="step" :class="{'step-primary': index == 1}"/>
        <li class="step" :class="{'step-primary': index == 2}"/>
    </ul>
</template>