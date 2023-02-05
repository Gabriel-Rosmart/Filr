<script setup>

    /** Component imports */
    import { Link } from '@inertiajs/inertia-vue3';

    defineProps({
        active: Number,
    })
</script>

<template>
    <div class="tabs">
        <Link href="/admin" class="tab tab-bordered" :class="{'tab-active': active == 0}">Hoy</Link>
        <Link href="/test" class="tab tab-bordered" :class="{'tab-active': active == 1}">Todos</Link>
    </div>
</template>