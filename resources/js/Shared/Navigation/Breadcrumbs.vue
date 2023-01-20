<script setup>
    import { FolderIcon } from '../Icons/Icons';
    import { Link } from '@inertiajs/inertia-vue3'
    defineProps({
        pages: Array
    })
</script>

<template>
    <div class="text-sm breadcrumbs">
        <ul>
        <li v-for="page in pages">
            <Link>
                <FolderIcon/>
                {{ page }}
            </Link>
        </li>
        </ul>
    </div>
</template>