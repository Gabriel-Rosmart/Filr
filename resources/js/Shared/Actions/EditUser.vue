<script setup>
    import { PlusIcon } from '../Icons/Icons';
    import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <Link as="button" href="/admin/edit" class="btn gap-2">
        <PlusIcon/>
        Edit User
    </Link>
</template>