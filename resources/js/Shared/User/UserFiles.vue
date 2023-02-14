<script setup>
    import { useI18n } from 'vue-i18n';
    import FilesTable from '@/Shared/Info/FilesAdminTable.vue';
    import Pagination from '@/Shared/Filters/Pagination.vue';

    const { t } = useI18n()

    const props = defineProps({
        files: Object
    })
</script>
<template>
    <div class="flex justify-left">
        <Pagination class="ml-4" :links="files.links"/>
    </div>
    <div class="flex justify-center mb-10">
        <FilesTable class="w-full mx-4 mt-8" :files="files.data"/>
    </div>
</template>