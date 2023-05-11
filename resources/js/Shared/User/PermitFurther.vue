<script setup>
    import FormFileInput from "@/Shared/Forms/FormFileInput.vue";
    
    import { useI18n } from 'vue-i18n';
    import { useForm } from '@inertiajs/inertia-vue3';

    const { t } = useI18n();

    const props = defineProps({
        permit: Object
    })

    function upFile(e)
    {
        console.log(e.target.files[0]);
        form.file = e.target.files[0];
    }

    function submit()
    {
        form.post('/user/permit')
    }

    const form = useForm({
        permit: props.permit,
        file: {
            value: null,
            rules: ['required']
        }
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
                <div class="stat-value text-xl whitespace-normal">{{ t('permits.' +  permit.permitType) }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Justificante</div>
                <div class="stat-value text-xl whitespace-normal">{{ permit.file ? permit.file : 'No se ha aportado un justificante' }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Cambiar/Añadir Justificante</div>
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <FormFileInput id="file" name="file"
                            v-on:change="upFile" />
                    <button type="submit" class="btn btn-primary mt-2 ml-5" @click="submit">{{ permit.file ? 'Cambiar' : 'Añadir' }}</button>
                </form>
            </div>
        </div>
    </div>
</template>