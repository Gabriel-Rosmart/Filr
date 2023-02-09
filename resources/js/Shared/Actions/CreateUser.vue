<script setup>
    import { PlusIcon } from '../Icons/Icons';
    import { Link } from '@inertiajs/inertia-vue3'
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()
</script>

<template>
    <Link as="button" href="/admin/register" class="btn gap-2">
        <PlusIcon/>
        {{ t('admin.buttons.adduser') }}
    </Link>
</template>