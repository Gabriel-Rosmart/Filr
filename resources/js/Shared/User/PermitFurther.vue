<script setup>
    import { useI18n } from 'vue-i18n';

    const { t } = useI18n();

    const props = defineProps({
        permit: Object
    })
</script>

<template>
    <div class="flex mb-4">
        <div class="stats stats-vertical shadow bg-slate-200 dark:bg-slate-800 w-1/2 p-2 mx-5">
            <div class="stat">
                <div class="stat-title">Fecha Inicio</div>
                <div class="stat-value">{{ permit.start_date }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Fecha Fin</div>
                <div class="stat-value">{{ permit.end_date }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Hora Inicio</div>
                <div class="stat-value">{{ permit.start_time }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Hora Fin</div>
                <div class="stat-value">{{ permit.end_time }}</div>
            </div>
        </div>
        <div class="stats stats-vertical shadow bg-slate-200 dark:bg-slate-800 w-1/2 p-2 mx-5">
            <div class="stat">
                <div class="stat-title">Tipo de Permiso</div>
                <div class="stat-value">{{ permit.permitType }}</div>
            </div>
            <div class="stat">
                <div class="stat-title"></div>
            </div>
        </div>
    </div>
</template>