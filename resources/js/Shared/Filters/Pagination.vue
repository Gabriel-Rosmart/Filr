<script setup>
    import { Link } from '@inertiajs/inertia-vue3'
    defineProps({
        links: Array
    })
</script>

<template>
    <div class="btn-group">
        <Link as="button" v-for="link in links" :href="link.url" v-html="link.label" class="btn" :class="{'btn-active': link.active}"></Link>
    </div>
</template>