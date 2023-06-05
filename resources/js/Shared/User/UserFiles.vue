<script setup>
    import { useI18n } from 'vue-i18n';
    import FilesTable from '@/Shared/Info/FilesAdminTable.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';
    import FilterFileDate from '../Filters/FilterFileDate.vue';

    const { t } = useI18n()

    const props = defineProps({
        files: Array,
        filter: Object,
        url: String,
        incidences: Array
    })
</script>
<template>
    
    
    <div class="flex justify-left mb-6 gap-6">
        <FilterFileDate :url="url" :filter = "filter"/>
        <Pagination v-if="files.data.length > 0" :links="files.links"/>  
        <label for="my-modal-2" class="btn btn-primary modal-button">Generar informe de fichajes</label>     </div>
    <div v-if="files.data.length > 0">    
        <div class="flex justify-center mb-10">
            <FilesTable class="w-full mx-4 mt-2" :files="files.data" :incidences="incidences"/>
        </div>
    </div>
    <div class="overflow-x-auto w-full" v-else>
        <div class="alert alert-info shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-current flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ t('admin.details.noFiles') }}</span>
            </div>
        </div>
    </div>
    
    
    
</template>