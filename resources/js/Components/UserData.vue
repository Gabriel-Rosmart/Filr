<script setup>
/* Components */
import InputForm from "@/Components/InputForm.vue";
import SelectForm from "@/Components/SelectForm.vue";
import FormInputError from "@/Shared/Forms/FormInputError.vue";

/* VUE Parameters */
import appconfig from "@/appconfig";
import { ref } from "vue";
import { useI18n } from 'vue-i18n'

const { t } = useI18n();
const props = defineProps({
    user: Object,
    form: Object,
    isAdmin: Number
})

console.table(props.user);
console.log(props.form);

const storage = ref(appconfig.STORAGE_URL);

function onFileChange(e) {
    let file = e.target.files;
    console.log(file);
    props.form.pic = file;
}

</script>

<template>
    <div class=" grid justify-items-center py-10 pl-10 ">
        <div class="grid grid-cols-2 w-max gap-6">
            <div class="grid row-span-3 justify-center items-center">
                <div class="avatar">
                    <div class="mask mask-squircle w-80 h-80">
                        <img class="hover:opacity-70" :src="storage + user.profile_pic" alt="Profile pic" />
                    </div>
                </div>
            </div>
            <div>
                <InputForm :title="t('forms.name')" type="text" v-model="form.name" :value='user.name' />
                <FormInputError v-if="form.errors.name!=undefined" class="mt-2" :message="t('forms.required')" />
            </div>
            <div>
                <InputForm :title="t('forms.dni')" type="text" v-model="form.dni" :value='user.dni' />
                <FormInputError v-if="form.errors.dni!=undefined" class="mt-2" :message="t('forms.required')" />
            </div>
            <div>
                <InputForm :title="t('forms.email')" type="email" v-model="form.email" :value='user.email' />
                <FormInputError v-if="form.errors.email!=undefined" class="mt-2" :message="t('forms.required')" />
            </div>
            <div class="flex flex-col gap-2">
                <label for="pic">{{ t('forms.pic') }}</label>
                <input type="file" name='pic' v-on:change="onFileChange"
                    class="file-input file-input-bordered w-full max-w-xs" />
                <FormInputError v-if="form.errors.pic!=undefined" class="mt-2" :message="t('forms.invalidImage')" />

            </div>
            <div>
                <InputForm :title="t('forms.telephone')" type="telephone" v-model="form.telephone" :value='user.phone' />
                <FormInputError v-if="form.errors.phone!=undefined" class="mt-2" :message="t('forms.required')" />
            </div>
            <SelectForm v-if="isAdmin == 1" title="Role" :data='3' :rol="user.role_id" />
            <div>
                <InputForm v-if="isAdmin == 0" :title="t('forms.password')" type="password" v-model="form.password" />
                <FormInputError v-if="form.errors.password!=undefined" class="mt-2" :message="t('forms.notValidPass')" />
            </div>
            <div>
                <InputForm v-if="isAdmin == 0" :title="t('forms.passwordConfirm')" type="password"
                    v-model="form.password_confirmation" />
                <FormInputError class="mt-2" :message="form.errors.password_confirmation" />

            </div>
        </div>
    </div>
</template>