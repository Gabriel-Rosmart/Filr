<script setup>
    import { PlusIcon } from '../Icons/Icons';
    import { Link } from '@inertiajs/inertia-vue3'

    const props = defineProps({
        user: Number
    })
</script>

<template>
    <Link as="button" :href="'/admin/edit?id=' + user" class="btn gap-2">
        <PlusIcon/>
        Edit User
    </Link>
</template>