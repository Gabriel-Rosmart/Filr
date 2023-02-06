<script setup>

    /** Icon imports */
    import { FolderIcon } from '../Icons/Icons';

    /** Component imports */
    import { Link } from '@inertiajs/inertia-vue3'
    
    defineProps({
        pages: Array
    })
</script>

<template>
    <div class="text-sm breadcrumbs">
        <ul>
        <li v-for="page in pages">
            <Link :href=page[1]>
                <FolderIcon/>
                {{ page[0] }}
            </Link>
        </li>
        </ul>
    </div>
</template>