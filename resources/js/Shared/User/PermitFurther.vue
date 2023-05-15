<script setup>
    import FormFileInput from "@/Shared/Forms/FormFileInput.vue";

    import { Link } from "@inertiajs/inertia-vue3";
    
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
                <div class="stat-title">Tipo de Justificante</div>
                <div class="stat-value text-xl whitespace-normal">{{ t('permits.' + permit.fileType) }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Justificante</div>
                <div class="stat-value text-xl whitespace-normal">
                    <a :href="'/user/permit/download/justification?uuid=' + permit.uuid" target="_blank" class="dark:hover:text-cyan-400 hover:underline">
                        {{ permit.file ? permit.file : 'No se ha aportado un justificante' }}
                    </a>
                </div>
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
    <div class="row px-5">
        <a class="btn btn-primary" :href="'/user/permit/download?uuid=' + permit.uuid">
            Descargar Permiso
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
    </div>
</template>