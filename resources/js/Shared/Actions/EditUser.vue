<script setup>
    import { SettingsIcon } from '../Icons/Icons';
    import { Link } from '@inertiajs/inertia-vue3';

    import { useI18n } from 'vue-i18n';

    const { t } = useI18n();

    const props = defineProps({
        user: Number
    })
</script>

<template>
    <Link as="button" :href="'/admin/edit?id=' + user" class="btn gap-2">
        <SettingsIcon/>
        {{ t('admin.buttons.edit') }}
    </Link>
</template>