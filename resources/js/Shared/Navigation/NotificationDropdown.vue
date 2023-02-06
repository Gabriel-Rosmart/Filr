<script setup>

    /** Icon imports */
    import { BellIcon } from '../Icons/Icons';

    /** Component imports */
    import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="dropdown dropdown-end">
        <button tabindex="0" class="btn btn-ghost btn-circle m-1">
            <div class="indicator">
                <BellIcon/>
                <span class="badge badge-xs badge-primary indicator-item"></span>
            </div>
        </button>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 whitespace-nowrap">
            <li>
                <Link href="/admin/permits">Nueva notificación</Link>
            </li>
        </ul>
    </div>
</template>