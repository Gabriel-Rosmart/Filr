<script setup>

/** Component imports */
import Steps from '@/Shared/Navigation/Steps.vue'
import FormTextInput from '@/Shared/Forms/FormTextInput.vue'
import FormInputError from '@/Shared/Forms/FormInputError.vue'
import FormCheckbox from '@/Shared/Forms/FormCheckbox.vue'
import FormLabel from '@/Shared/Forms/FormLabel.vue'
import FormTime from '../Forms/FormTime.vue'
import { useForm } from '@inertiajs/inertia-vue3'

/** Function imports */
import { ref } from 'vue'
import { range } from 'lodash'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const props = defineProps({
    users: Array
})

let currentStep = ref(0)

const form = useForm({
    name: '',
    dni: '',
    telephone: '',
    email: '',
    admin: false,
    role: '',
    substitute: {
        is: false,
        name: ''
    },
    dates: {
        start: '',
        end: ''
    },
    schedules: {
        monday: [null, null, null, null],
        tuesday: [null, null, null, null],
        wednesday: [null, null, null, null],
        thursday: [null, null, null, null],
        friday: [null, null, null, null]
    }
});

const submit = () => {

    form.post('/admin/register');

};

</script>

<template>
    <h2 class="mb-12 text-center text-5xl font-extrabold mt-10">New User</h2>
    <div class="flex justify-center mt-24">
        <Steps :index="currentStep" />
    </div>
    <div class="flex justify-center">
        <form @submit.prevent="" class=" block h-80">
            <div class="w-full flex flex-col justify-center">
                <div class="flex flex-col justify-center">
                    <span v-for="error in form.errors" class="block w-full text-center">
                        <FormInputError :message="error" />
                    </span>
                </div>
            </div>
            <!-- Step 1 of form -->
            <div class="flex flex-col mt-6">
                <div>
                    <div class="flex flex-col" v-show="currentStep == 0">
                        <div class="flex gap-6">
                            <div class="flex flex-col">
                                <FormLabel :value="t('forms.name')" />
                                <FormTextInput type="text" class="mt-1 block w-full mb-6" v-model="form.name" />

                                <FormLabel :value="t('forms.dni')" />
                                <FormTextInput type="text" class="mt-1 block w-full" v-model="form.dni" />
                            </div>
                            <div class="flex flex-col">
                                <FormLabel :value="t('forms.email')" />
                                <FormTextInput type="email" class="mt-1 block w-full mb-6" v-model="form.email" />

                                <FormLabel :value="t('forms.telephone')" />
                                <FormTextInput type="telephone" class="mt-1 block w-full" v-model="form.telephone" />
                            </div>
                        </div>
                        <div class="flex flex-col mt-6">
                            <div class="mb-4" v-show="form.substitute.is">
                                <select class="select select-bordered w-full" disabled>
                                    <option value="" disabled selected>Rol</option>
                                    <option value="profesor">Profesor</option>
                                    <option value="administrativo">Administrativo</option>
                                    <option value="limpieza">Limpieza</option>
                                </select>
                            </div>
                            <div class="mb-4" v-show="!form.substitute.is">
                                <select class="select select-bordered w-full" v-model="form.role">
                                    <option value="" disabled selected>Rol</option>
                                    <option value="profesor">Profesor</option>
                                    <option value="administrativo">Administrativo</option>
                                    <option value="limpieza">Limpieza</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <FormCheckbox name="remember" v-model:checked="form.admin" class="" />
                                <span class="ml-2 label">Admin</span>
                                <FormCheckbox name="remember" v-model:checked="form.substitute.is" class="ml-8" />
                                <span class="ml-2 label">Sustituto</span>
                            </div>
                            <div v-show="form.substitute.is" class="mt-4">
                                <select class="select select-bordered w-full" v-model="form.substitute.name">
                                    <option value="" disabled selected>Teacher</option>
                                    <option v-for="user of users" :key="user.id">{{ user.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Step 2 of form -->
                <div class="flex mt-7 gap-6" v-show="currentStep == 1">
                    <input type="date" class="input input-bordered dark:input-primary" v-model="form.dates.start">
                    <input type="date" class="input input-bordered dark:input-primary" v-model="form.dates.end">
                </div>
                <!-- Step 3 of form -->
                <div class="overflow-x-auto" v-show="currentStep == 2">
                    <table class="table w-full">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>{{ t('forms.inmorning') }}</th>
                                <th>{{ t('forms.outmorning') }}</th>
                                <th>{{ t('forms.innoon') }}</th>
                                <th>{{ t('forms.outnoon') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="day of Object.keys(form.schedules)">
                                <th>{{ t(`days.${day}`) }}</th>
                                <td v-for="index in range(4)">
                                    <FormTime v-model="form.schedules[day][index]" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end mt-6">
                    <button class="btn btn-outline btn-primary mr-4" @click="currentStep--" v-show="currentStep > 0">
                        {{ t('admin.buttons.prev') }}
                    </button>
                    <button class="btn btn-outline btn-primary" @click="currentStep++"
                        v-show="currentStep < 2 && !form.substitute.is">
                        {{ t('admin.buttons.next') }}
                    </button>
                    <button class="btn btn-primary" @click="submit" v-show="currentStep == 2 || form.substitute.is">
                        {{ t('admin.buttons.send') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>