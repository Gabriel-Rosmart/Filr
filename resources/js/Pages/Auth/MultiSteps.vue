<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['Register', '/admin/manage/register']]" />
        <div class="w-full min-h-full flex flex-col sm:justify-center items-center sm:pt-0">
            <div class="p-5 min-h-full">
                <div class="my-6">
                    <h2 class="mb-12 text-center text-5xl font-extrabold">New User</h2>
                </div>
                <div class="flex flex-col items-center">
                    <component v-bind:is="step[currentStep]" :users="users" />
                </div>
                <div class="flex gap-2 justify-end mx-7">
                    <div class="mt-6">
                        <button class="btn btn-outline btn-primary" v-if="currentStep !== 0"
                            @click="currentStep--">Anterior</button>
                    </div>
                    <div class="mt-6">
                        <button class="btn btn-outline btn-primary" v-if="currentStep < step.length - 1"
                            @click="currentStep++">Next</button>
                    </div>
                    <div class="mt-6">
                        <button class="btn btn-primary" v-if="currentStep == step.length - 1">Send</button>
                    </div>
                    <div class="mt-6" v-show="isChecked">
                        <button class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import About from '@/Components/Steps/About.vue';
import Information from '@/Components/Steps/Information.vue';
import Profile from '@/Components/Steps/Profile.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { ref } from 'vue';

let currentStep = ref(0)
let step = ref([Information, About, Profile])



const props = defineProps({
    users: Array
})

</script>