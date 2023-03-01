<script setup>
import FormLabel from '@/Shared/Forms/FormLabel.vue'
import FormRadioButton from "@/Shared/Forms/FormRadiobutton.vue";
import FormFileInput from "@/Shared/Forms/FormFileInput.vue";
import FormOneDate from "@/Shared/Forms/FormOneDate.vue";
import FormMultiDate from "@/Shared/Forms/FormMultiDate.vue";
import FormTextInput from "@/Shared/Forms/FormTextInput.vue";

import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useI18n } from 'vue-i18n';



const { t } = useI18n();

let currentComponentIndex = ref(0);
const dates = [null, FormOneDate, FormMultiDate];

const form = useForm({
    nDays : null,
    day : null,
    dayOut : null,
    hStart : null,
    hEnd : null,
    nHours : null,
    affected : null,
    file : null,
    type : null,

});

function upFile(e)
{
    console.log(e.target.files[0]);
    form.file = e.target.files[0];
}

function submit()
{
    form.post('/user/permitreq')
}
</script>
<template>
    <div class="flex justify-center items-center mt-8">
        <form @submit.prevent="" class="w-11/12 pr-10">
            <div class="grid grid-flow-row">
                <h2 class="text-xl mt-5">{{ t('permits.data') }}</h2>
                <div class="border-2 dark:border-slate-700 rounded-lg p-2">
                    <div class="flex flex-row w-full">
                        <div class="flex flex-row w-3/12">
                            <FormLabel for="single" :value="t('permits.labels.oneday')" class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full"
                                @click="currentComponentIndex = 1" />
                            <FormRadioButton name="selection" id="single" class="mx-5 my-3"
                                @click="currentComponentIndex = 1" 
                                v-model="form.nDays" value="o"/>
                            <FormLabel for="multi" :value="t('permits.labels.mulday')" class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full"
                                @click="currentComponentIndex = 2" />
                            <FormRadioButton name="selection" id="multi" class="mx-5 my-3"
                                @click="currentComponentIndex = 2" 
                                v-model="form.nDays" value="m"/>
                        </div>
                        <div class="mr-14">
                            <component :is="dates[currentComponentIndex]" :form="form"/>
                        </div>
                    </div>
                    <div class="flex flex-row mt-3">
                        <FormLabel for="hours" :value="t('permits.labels.hours')" class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 mx-2" />
                        <FormTextInput name="hours" id="hours" label="hours" class="mx-2"
                            v-model="form.nHours"/>
                        <FormLabel for="affected" :value="t('permits.labels.affected')" class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 mx-2" />
                        <FormTextInput name="affected" id="affected" label="Grupos afectados" class="mx-2"
                            v-model="form.affected"/>
                    </div>
                </div>
                <h2 class="text-xl mt-5">{{ t('permits.type') }}</h2>
                <div class="border-2 dark:border-slate-700 rounded-lg p-2">
                    <h4 class="text-lg mb-5">{{ t('permits.permits') }}</h4>
                    <div class="grid grid-cols-2 w-auto">
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="death" :value="t('permits.death')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="death" class="mx-5 my-3"
                                value="death"/>
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="move" :value="t('permits.move')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="move" class="mx-5 my-3"
                                value="move"/>
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="exam" :value="t('permits.exam')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="exam" class="mx-5 my-3"
                                value="exam"/>
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="prenat" :value="t('permits.prenat')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="prenat" class="mx-5 my-3"
                                value="prenat"/>
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="fecAs" :value="t('permits.fecAs')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="fecAs" class="mx-5 my-3"
                                value="fecAs"/>
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="marriage" :value="t('permits.marriage')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="marriage" class="mx-5 my-3"
                                value="marriage"/>
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="duties" :value="t('permits.duties')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="duties" class="mx-5 my-3"
                                value="duties"/>
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="particularBussines" :value="t('permits.particularBussines')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="particularBussin"
                                class="mx-5 my-3" value="particular"/>
                        </div>
                    </div>
                    <h4 class="text-lg mb-5">{{ t('permits.unexpections') }}</h4>
                    <div class="grid grid-cols-2 w-auto">
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="unexpection" :value="t('permits.unexpection')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="permitType" v-model="form.type" id="unexpection" class="mx-5 my-3"
                                value="unexpection"/>
                        </div>
                    </div>
                </div>
                <h2 class="text-xl mt-5">{{ t('permits.doc') }}</h2>
                <div class="flex flex-col border-2 dark:border-slate-700 rounded-lg p-2 justify-center">
                    <div class="grid grid-cols-2 w-auto">
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="famBook" :value="t('permits.famBook')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="famBook" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="censusdoc" :value="t('permits.censusdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="censusdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="deathdoc" :value="t('permits.deathdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="deathdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="marriagedoc" :value="t('permits.marriagedoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="marriagedoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="hospdoc" :value="t('permits.hospdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="hospdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="birthdoc" :value="t('permits.birthdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="birthdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="convdoc" :value="t('permits.convdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="convdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="examdoc" :value="t('permits.examdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="examdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="prenatdoc" :value="t('permits.prenatdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="prenatdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="idondoc" :value="t('permits.idondoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="idondoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="fecasdoc" :value="t('permits.fecasdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="fecasdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="revmeddoc" :value="t('permits.revmeddoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="revmeddoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="alonedoc" :value="t('permits.alonedoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="alonedoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="citationdoc" :value="t('permits.citationdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="citationdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="electiondoc" :value="t('permits.electiondoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="electiondoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="reuniondoc" :value="t('permits.reuniondoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="reuniondoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="EUdoc" :value="t('permits.EUdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="EUdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="responsabilitydoc" :value="t('permits.responsabilitydoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="responsabilitydoc"
                                class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="donationdoc" :value="t('permits.donationdoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="donationdoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="athletedoc" :value="t('permits.athletedoc')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="athletedoc" class="mx-5 my-3" />
                        </div>
                        <div class="flex flex-row gap-5 mb-4 ml-10 text-justify justify-between">
                            <FormLabel for="other" :value="t('permits.other')"
                                class="hover:bg-gray-200 dark:hover:bg-slate-800 rounded-lg p-3 w-full" />
                            <FormRadioButton name="document" v-model:checked="falso" id="other" class="mx-5 my-3" />
                        </div>
                    </div>
                    <div class="flex flex-row mb-4 text-justify justify-center">
                        <FormFileInput id="file" name="file"
                            v-on:change="upFile" />
                    </div>
                </div>
                <div class="flex justify-center mt-8 w-full">
                    <button class="btn btn-outline btn-primary w-6/12" @click="submit">{{ t('permits.send') }}</button>
                </div>
            </div>
        </form>
    </div>
</template>