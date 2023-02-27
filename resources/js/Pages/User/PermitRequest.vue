<script setup>
    import UserLayout from '@/Layouts/UserLayout.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';

    import { useI18n } from 'vue-i18n';

    const { t } = useI18n();
</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[[t('breadcrumbs.user'), '/user'], ['Dashboard', '/user']]" />
    </UserLayout>
</template>