<script setup>
    import { PlusIcon } from '../Icons/Icons';
    import { Link } from '@inertiajs/inertia-vue3';

    import { useI18n } from 'vue-i18n';

    const { t } = useI18n();

    const props = defineProps({
        user: Number
    })
</script>

<template>
    <Link as="button" :href="'/admin/dates?id=' + user" class="btn gap-2">
        <PlusIcon/>
        {{ t('admin.buttons.dates') }}
    </Link>
</template>