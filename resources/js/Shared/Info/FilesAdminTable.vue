<script setup>
    import { useI18n } from 'vue-i18n';

    const { t, d } = useI18n()

    const props = defineProps({
        files: Array
    })

    console.table(props.files)
</script>

<template>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>{{ t('table.date') }}</th>
                    <th>{{ t('table.in') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file of files" class="hover">
                    <td> {{ d(file.date, 'short') }} </td>
                    <td> {{ file.timestamp }} </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>