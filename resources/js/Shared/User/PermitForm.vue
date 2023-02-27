<script setup>
import FormLabel from '@/Shared/Forms/FormLabel.vue'
import FormCheckbox from '@/Shared/Forms/FormCheckbox.vue';
import FormRadioButton from "@/Shared/Forms/FormRadiobutton.vue";
import FormFileInput from "@/Shared/Forms/FormFileInput.vue";

import { useForm } from '@inertiajs/inertia-vue3';
import { useI18n } from 'vue-i18n';



const { t } = useI18n();

const form = useForm({
    falso: false
});
</script>
<template>
    <div class="flex items-center mt-8">
        <form @submit.prevent="" class="w-full pr-10">
            <div class="grid grid-flow-row">
                <h2 class="text-xl">Tipo de Permiso</h2>
                <div class="border-2 rounded-lg p-2">
                    <h4 class="text-lg mb-5">Permisos</h4>
                    <div class="grid grid-cols-2 w-auto">
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="death" :value="t('permits.death')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="death" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="move" :value="t('permits.move')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="move" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="exam" :value="t('permits.exam')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="exam" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="prenat" :value="t('permits.prenat')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="prenat" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="fecAs" :value="t('permits.fecAs')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="fecAs" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="marriage" :value="t('permits.marriage')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="marriage" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="duties" :value="t('permits.duties')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="duties" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="particularBussines" :value="t('permits.particularBussines')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="particularBussines"
                                class="mx-5 my-3" />
                        </div>
                    </div>
                    <h4 class="text-lg mb-5">Ausencias imprevistas</h4>
                    <div class="grid grid-cols-2 w-auto">
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="unexpection" :value="t('permits.unexpection')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model:checked="falso" id="unexpection"
                                class="mx-5 my-3" />
                        </div>
                    </div>
                </div>
                <h2 class="text-xl mt-5">Documentación que se achega</h2>
                <div class="border-2 rounded-lg p-2">
                    <div class="grid grid-cols-2 w-auto">
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="census" :value="t('permits.census')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="census"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="deathdoc" :value="t('permits.deathdoc')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="deathdoc"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook"
                                class="mx-5 my-3" />
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div></template>