<script setup>
import InputForm from "@/Components/InputForm.vue";
import {useI18n } from 'vue-i18n';

const { t } = useI18n()
const props = defineProps({
    weekend: Array,
})

</script>

<template>
    <div class="flex justify-center">
        <table class="table w-max">
            <thead>
                <tr class="">
                    <th></th>
                    <th>{{ t('forms.inmorning') }}</th>
                    <th>{{ t('forms.outmorning') }}</th>
                    <th>{{ t('forms.innoon')}}</th>
                    <th>{{ t('forms.outnoon') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="day in weekend">
                    <th>{{ day.day }}</th>
                    <td>
                        <InputForm type="time" :value='day.starts_at' />
                    </td>
                    <td>
                        <InputForm type="time" :value='day.ends_at' />
                    </td>
                    <td>
                        <InputForm type="time" :value='day.starts_at' />
                    </td>
                    <td>
                        <InputForm type="time" :value='day.ends_at' />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>