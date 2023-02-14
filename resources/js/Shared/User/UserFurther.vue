<script setup>
    import { useI18n } from 'vue-i18n';

    const { t } = useI18n();

    const props = defineProps({
        user: Object
    })
</script>

<template>
    <div class="stats stats-vertical shadow bg-slate-200 dark:bg-slate-800">
        <div class="stat">
           <div class="stat-title">{{ t('admin.details.user.dni') }}</div>
           <div class="stat-value">{{ user.dni }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">{{ t('admin.details.user.telephone') }}</div>
            <div class="stat-value">{{ user.phone }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">{{ t('admin.details.user.position') }}</div>
            <div class="stat-value">{{ user.role.role_name }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">{{ t('admin.details.user.email') }}</div>
            <div class="stat-value">{{ user.email }}</div>
        </div>
    </div>
</template>