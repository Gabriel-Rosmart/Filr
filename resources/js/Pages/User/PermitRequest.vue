<script setup>
    import UserLayout from '@/Layouts/UserLayout.vue';
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
    import PermitForm from '@/Shared/User/PermitForm.vue';

    import { useI18n } from 'vue-i18n';

    const { t } = useI18n();
</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[[t('breadcrumbs.user'), '/user'], [t('breadcrumbs.dashboard'), '/user']]" />
        <PermitForm class="flex items-center m-8"/>
    </UserLayout>
</template>